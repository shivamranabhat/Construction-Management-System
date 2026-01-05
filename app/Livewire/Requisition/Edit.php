<?php

namespace App\Livewire\Requisition;

use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\Item;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public $requisition;
    public $project_id;
    public $required_date;
    public $purpose;
    public $items = [];
    public $userProjects;
    public $singleProject = false;

    // NEW: Add these
    public $isLocked = false;
    public $lockReason = '';

    public function mount(Requisition $requisition)
    {
        // Check if requisition is locked (fully approved or PO created)
        if (in_array($requisition->status, ['owner_approved', 'po_created'])) {
            $this->isLocked = true;
            $this->lockReason = $requisition->status === 'owner_approved' 
                ? 'This requisition is fully approved and cannot be edited.'
                : 'A Purchase Order has been created. Editing is not allowed.';
        }

         $projects = Project::query()
            ->when(Auth::user()->type === 'Company', function ($q) {
                return $q->where('company_id', Auth::user()->company_id);
            }, function ($q) {
                return $q->whereHas('users', fn($sub) => $sub->where('user_id', Auth::id()));
            })
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id');

        $this->userProjects = $projects;

        // auto-select logic stays the same
        if ($projects->count() === 1) {
            $this->project_id    = $projects->keys()->first();
            $this->singleProject = true;
        }

        $this->requisition = $requisition;
        $this->project_id = $requisition->project_id;
        $this->required_date = Carbon::parse($requisition->required_date)->format('Y-m-d');
        $this->purpose = $requisition->purpose;

        foreach ($requisition->items as $item) {
            $this->items[] = [
                'id' => $item->id,
                'item_id' => $item->item_id,
                'quantity' => $item->quantity,
                'remarks' => $item->remarks,
            ];
        }
    }

    public function addItemRow()
    {
        if ($this->isLocked) {
            $this->dispatch('toast', type: 'error', message: $this->lockReason);
            return;
        }
        $this->items[] = ['item_id' => '', 'quantity' => 1, 'remarks' => ''];
    }

    public function removeItemRow($index)
    {
        if ($this->isLocked) {
            $this->dispatch('toast', type: 'error', message: $this->lockReason);
            return;
        }

        $itemId = $this->items[$index]['id'] ?? null;
        if ($itemId) {
            RequisitionItem::find($itemId)->delete();
        }
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function save()
    {
        if ($this->isLocked) {
            $this->dispatch('toast', type: 'error', message: $this->lockReason);
            return;
        }

        $this->validate([
            'project_id' => 'required',
            'required_date' => 'required|date|after:today',
            'purpose' => 'required',
            'items.*.item_id' => 'required',
            'items.*.quantity' => 'required|numeric|min:0.01',
        ]);

        $this->requisition->update([
            'project_id' => $this->project_id,
            'required_date' => $this->required_date,
            'purpose' => $this->purpose,
        ]);

        $existingIds = [];
        foreach ($this->items as $itemData) {
            $data = [
                'item_id' => $itemData['item_id'],
                'quantity' => $itemData['quantity'],
                'remarks' => $itemData['remarks'] ?? null,
            ];

            if (isset($itemData['id'])) {
                $item = RequisitionItem::find($itemData['id']);
                $item->update($data);
                $existingIds[] = $item->id;
            } else {
                $newItem = RequisitionItem::create(array_merge($data, [
                    'requisition_id' => $this->requisition->id,
                ]));
                $existingIds[] = $newItem->id;
            }
        }

        RequisitionItem::where('requisition_id', $this->requisition->id)
            ->whereNotIn('id', $existingIds)
            ->delete();

        session()->flash('success', 'Requisition updated successfully!');
        return redirect()->route('requisition.index');
    }

    public function render()
    {
        $companyId = auth()->user()->company_id;
        $availableItems = Item::where('company_id', $companyId)->pluck('name', 'id');
        return view('livewire.requisition.edit', compact('availableItems'));
    }
}