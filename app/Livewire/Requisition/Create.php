<?php

namespace App\Livewire\Requisition;

use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\RequisitionApproval;
use App\Models\Item;
use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $project_id = '';
    public $required_date;
    public $purpose = '';
    public $items = [];
    public $itemSearch = '';

    public $userProjects;     // Collection of user's projects
    public $singleProject = false;

    public function mount()
    {
        $this->required_date = now()->addDays(7)->format('Y-m-d');

        // Get ONLY projects user is assigned to via project_user pivot
        $this->userProjects = Project::whereHas('users', fn($q) => $q->where('user_id', auth()->id()))->get()->pluck('name', 'id');
            

        // Auto-select if only one project
        if ($this->userProjects->count() === 1) {
            $this->project_id = $this->userProjects->keys()->first();
            $this->singleProject = true;
        }

        $this->addItemRow();
    }

    public function addItemRow()
    {
        $this->items[] = [
            'item_id' => '',
            'quantity' => 1,
            'unit' => 'nos',
            'remarks' => ''
        ];
    }

    public function removeItemRow($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updatedItemSearch()
    {
        // Required for live search
    }

    protected function createApprovalChain($requisition)
    {
        $project = $requisition->project;
        $errors = [];

        // 1. Project Manager (assigned to this project + has role 'project-manager')
        $pm = $project->users()
            ->whereHas('roles', fn($q) => $q->where('slug', 'project-manager'))
            ->first();

        if (!$pm) {
            $errors[] = "No Project Manager assigned to project '{$project->name}'.";
        }

        // 2. Procurement Manager (any in company)
        $procurement = User::whereHas('roles', fn($q) => $q->where('slug', 'procurement-manager'))
        ->where('company_id',auth()->user()->company_id)
        ->first();

        if (!$procurement) {
            $errors[] = "No Procurement Manager found in your company.";
        }

        // 3. Owner
        $owner = User::where('type','company')
        ->where('company_id',auth()->user()->company_id)
        ->first();
        if (!$owner) {
            $errors[] = "No Company Owner found.";
        }

        if (!empty($errors)) {
            $this->addError('approval_chain', implode('<br>', $errors));
            return false;
        }

        // Create approvals
        RequisitionApproval::create([
            'requisition_id' => $requisition->id,
            'company_id'=>auth()->user()->company_id,
            'approver_id' => $pm->id,
            'level' => 'pm',
            'status' => 'pending',
        ]);

        RequisitionApproval::create([
            'requisition_id' => $requisition->id,
            'approver_id' => $procurement->id,
            'company_id'=>auth()->user()->company_id,
            'level' => 'procurement',
            'status' => 'pending',
        ]);

        RequisitionApproval::create([
            'requisition_id' => $requisition->id,
            'approver_id' => $owner->id,
            'company_id'=>auth()->user()->company_id,
            'level' => 'Company',
            'status' => 'pending',
        ]);

        return true;
    }

    public function save()
    {
        $this->validate([
            'project_id' => 'required|exists:projects,id',
            'required_date' => 'required|date|after:today',
            'purpose' => 'required|string|max:1000',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.01',
        ]);

        return \DB::transaction(function () {
            $requisition = Requisition::create([
                'project_id' => $this->project_id,
                'requested_by' => auth()->id(),
                'required_date' => $this->required_date,
                'purpose' => $this->purpose,
                'requisition_number' => Requisition::generateRequisitionNumber(),
                'company_id' => auth()->user()->company_id,
                'status' => 'pending_pm',
                'slug'=> Str::slug(Requisition::generateRequisitionNumber())
            ]);

            foreach ($this->items as $item) {
                RequisitionItem::create([
                    'requisition_id' => $requisition->id,
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'company_id' => auth()->user()->company_id,
                    'remarks' => $item['remarks'] ?? null,
                ]);
            }

            if (!$this->createApprovalChain($requisition)) {
                return;
            }

            $this->dispatch('toast', [
                'title' => 'Success!',
                'message' => "Requisition #{$requisition->requisition_number} created!",
                'type' => 'success'
            ]);

            return redirect()->route('requisition.index');
        });
    }

    public function render()
    {
        $companyId = auth()->user()->company_id;

        $availableItems = Item::where('company_id', $companyId)
            ->when($this->itemSearch, fn($q) => $q->where('name', 'like', "%{$this->itemSearch}%")
                ->orWhere('code', 'like', "%{$this->itemSearch}%"))
            ->limit(30)
            ->get()
            ->mapWithKeys(fn($i) => ["{$i->code} - {$i->name}" => $i->id])
            ->toArray();

        return view('livewire.requisition.create', [
            'availableItems' => $availableItems,
        ]);
    }
}