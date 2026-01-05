<?php

namespace App\Livewire\Log;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Log;
use App\Models\Stock;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $log;
    public $slug;
    public $project_id;
    public $date;
    public $tasks = '';
    public $manpower_count = 0;
    public $hours = 0;
    public $itemRows = [];

    public $availableStocks = [];
    public $originalItemsUsed = []; // To track changes for stock rollback

    protected $rules = [
        'project_id' => 'required|exists:projects,id',
        'date' => 'required|date',
        'manpower_count' => 'required|integer|min:0',
        'hours' => 'required|numeric|min:0',
        'tasks' => 'nullable|string',
        'itemRows.*.item_id' => 'required|exists:items,id',
        'itemRows.*.quantity' => 'required|integer|min:1',
    ];

    public function mount($slug)
    {
        $this->authorize('update-log');

        $this->log = Log::where('slug', $slug)->firstOrFail();
        // Prevent editing approved logs
        if ($this->log->status === 'approved') {
            session()->flash('error', 'Approved logs cannot be edited.');
            return redirect()->route('log.index');
        }
        
        $this->project_id = $this->log->project_id;
        $this->date = Carbon::parse($this->log->date)->format('Y-m-d');
        $this->manpower_count = $this->log->manpower_count;
        $this->hours = $this->log->hours;
        $this->tasks = is_array($this->log->tasks) ? implode("\n", $this->log->tasks) : '';

        // Load existing items used
        $this->itemRows = $this->log->items_used ?? [];
        $this->originalItemsUsed = $this->log->items_used ?? []; // For rollback if needed

        $this->loadAvailableStocks();
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
                // Allow up to current stock + original quantity (since it was already used)
                $originalQty = 0;
                foreach ($this->originalItemsUsed as $orig) {
                    if ($orig['item_id'] == $itemId) {
                        $originalQty = $orig['quantity'];
                        break;
                    }
                }
                $maxAllowed = ($stock['available'] ?? 0) + $originalQty;

                if ($quantity > $maxAllowed) {
                    $this->addError("itemRows.$index.quantity", "Only $maxAllowed available (including previously used).");
                } else {
                    $this->resetErrorBag("itemRows.$index.quantity");
                }
            }
        }
    }
    public function getIsDisabledProperty()
    {
        return in_array($this->log->status, ['approved', 'rejected']);
    }


    public function update()
    {
        $this->validate();

        // Server-side stock validation (considering original usage)
        foreach ($this->itemRows as $index => $row) {
            if (empty($row['item_id'])) continue;

            $stock = Stock::where('project_id', $this->project_id)
                          ->where('item_id', $row['item_id'])
                          ->first();

            $originalQty = 0;
            foreach ($this->originalItemsUsed as $orig) {
                if ($orig['item_id'] == $row['item_id']) {
                    $originalQty = $orig['quantity'];
                    break;
                }
            }

            $needed = $row['quantity'] - $originalQty;

            if ($needed > 0 && (!$stock || $needed > $stock->stock)) {
                $itemName = $stock?->item->name ?? 'Item';
                $available = $stock?->stock ?? 0;
                $this->addError("itemRows.$index.quantity", "Not enough stock for $itemName. Only $available additional available.");
                return;
            }
        }

        $tasksArray = $this->tasks ? array_filter(explode("\n", trim($this->tasks))) : [];
        $itemsUsed = array_filter($this->itemRows, fn($row) => !empty($row['item_id']));

        // Update the log
        $this->log->update([
            'date' => $this->date,
            'tasks' => $tasksArray,
            'manpower_count' => $this->manpower_count,
            'hours' => $this->hours,
            'items_used' => $itemsUsed,
            // Status remains the same (still pending/rejected)
        ]);

        session()->flash('success', 'Daily log updated successfully!');

        return redirect()->route('log.index');
    }

    public function render()
    {
        return view('livewire.log.edit');
    }
}