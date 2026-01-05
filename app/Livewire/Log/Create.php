<?php

namespace App\Livewire\Log;

use Livewire\Component;
use App\Models\Project;
use App\Models\Stock;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $project_id;
    public $date;
    public $tasks = '';
    public $manpower_count = 0;
    public $hours = 0;

    public $itemRows = [];

    public $userProjects = [];       // All accessible projects (for dropdown)
    public $availableStocks = [];     // Stocks for selected project
    public $noProjectAccess = false;
    public $singleProject = false;

    public $projectName = '';        // For display if single project

    protected $rules = [
        'project_id' => 'required|exists:projects,id',
        'date' => 'required|date',
        'manpower_count' => 'required|integer|min:0',
        'hours' => 'required|numeric|min:0',
        'tasks' => 'nullable|string',
        'itemRows.*.item_id' => 'required|exists:items,id',
        'itemRows.*.quantity' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $this->date = today()->format('Y-m-d');
        $this->manpower_count = 0;
        $this->hours = 0;
        $this->tasks = '';

        // === Project Access Logic Based on User Type ===
        $query = Project::query();

        if (Auth::user()->type === 'Company') {
            // Company user sees all projects of their company
            $query->where('company_id', Auth::user()->company_id);
        } else {
            // Regular user sees only assigned projects
            $query->whereHas('users', fn($q) => $q->where('user_id', Auth::id()));
        }

        $projects = $query->orderBy('name')->get();

        if ($projects->isEmpty()) {
            $this->noProjectAccess = true;
            $this->addError('project_access', 'You are not assigned to any project. Contact your admin.');
            return;
        }

        // Store projects for dropdown: ['id' => 'Project Name']
        $this->userProjects = $projects->pluck('name', 'id');

        // If only one project, auto-select it
        if ($projects->count() === 1) {
            $this->project_id = $projects->first()->id;
            $this->singleProject = true;
            $this->projectName = $projects->first()->name;
            $this->loadAvailableStocks();
        }

        // Start with one empty item row
        $this->addItemRow();
    }

    public function updatedProjectId()
    {
        $this->resetValidation();
        $this->loadAvailableStocks();
    }

    public function loadAvailableStocks()
    {
        if (!$this->project_id) {
            $this->availableStocks = [];
            return;
        }

        $this->availableStocks = Stock::where('project_id', $this->project_id)
            ->with('item')
            ->get()
            ->map(function ($stock) {
                return [
                    'item_id' => $stock->item_id,
                    'name' => $stock->item->name ?? 'Unknown Item',
                    'available' => $stock->stock,
                ];
            })
            ->toArray();
    }

    public function addItemRow()
    {
        $this->itemRows[] = ['item_id' => '', 'quantity' => 1];
    }

    public function removeItemRow($index)
    {
        unset($this->itemRows[$index]);
        $this->itemRows = array_values($this->itemRows);
    }

    public function updatedItemRows($value, $key)
    {
        $parts = explode('.', $key);
        if (isset($parts[1]) && $parts[1] === 'quantity') {
            $index = $parts[0];
            $itemId = $this->itemRows[$index]['item_id'] ?? null;
            $quantity = $value;

            if ($itemId && $quantity) {
                $stock = collect($this->availableStocks)->firstWhere('item_id', $itemId);
                if ($stock && $quantity > $stock['available']) {
                    $this->addError("itemRows.$index.quantity", "Only {$stock['available']} available.");
                } else {
                    $this->resetErrorBag("itemRows.$index.quantity");
                }
            }
        }
    }

    public function submit()
    {
        $this->validate();

        // Final server-side stock availability check (for both cases)
        foreach ($this->itemRows as $index => $row) {
            if (empty($row['item_id'])) {
                continue;
            }

            $stock = Stock::where('project_id', $this->project_id)
                        ->where('item_id', $row['item_id'])
                        ->first();

            if (!$stock || $row['quantity'] > $stock->stock) {
                $itemName = $stock?->item->name ?? 'Item';
                $available = $stock?->stock ?? 0;
                $this->addError("itemRows.$index.quantity", "Cannot use {$row['quantity']} of $itemName. Only $available available.");
                return;
            }
        }

        // Determine status and whether to deduct stock now
        $isCompanyAdmin = Auth::user()->type === 'Company';
        $status = $isCompanyAdmin ? 'approved' : 'pending';

        // Create the log
        $log = Log::create([
            'project_id'   => $this->project_id,
            'company_id'   => Auth::user()->company_id ?? Project::find($this->project_id)->company_id,
            'date'         => $this->date,
            'tasks'        => $this->tasks ? array_filter(explode("\n", trim($this->tasks))) : [],
            'manpower_count' => $this->manpower_count,
            'hours'        => $this->hours,
            'photos'       => [],
            'items_used'   => array_filter($this->itemRows, fn($row) => !empty($row['item_id'])),
            'status'       => $status,
        ]);

        // If company admin → deduct stock immediately
        if ($isCompanyAdmin && !empty($log->items_used)) {
            foreach ($log->items_used as $used) {
                Stock::where('project_id', $this->project_id)
                    ->where('item_id', $used['item_id'])
                    ->decrement('stock', $used['quantity']);
            }
        }

        // Success message
        $message = $isCompanyAdmin
            ? 'Daily log created and stock updated successfully!'
            : 'Daily log submitted successfully!';
        session()->flash('success', $message);

        return redirect()->route('log.index');
    }

    public function render()
    {
        return view('livewire.log.create');
    }
}