<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\Item;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Tax;
use App\Models\Vendor;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    // Form
    public $bill_date;
    public $bill_number;
    public $vendor_id = '';
    public $project_id = '';
    public $status = 'draft';
    public $notes = '';
    public $total_price = 0;

    // Line Items
    public $lines = [];

    // Item Search
    public $itemSearch = '';
    public $showItemDropdown = false;
    public $selectedLineIndex = null;
    public $itemResults = [];

    protected function rules()
    {
        return [
            'bill_date' => 'required|date',
            'bill_number' => 'required|string|unique:bills,bill_number',
            'vendor_id' => 'required|exists:vendors,id',
            'project_id' => 'nullable|exists:projects,id',
            'status' => 'required|in:draft,paid,partial',
            'notes' => 'nullable|string',
            'lines' => 'required|array|min:1',
            'lines.*.name' => 'required|string',
            'lines.*.quantity' => 'required|integer|min:1',
            'lines.*.unit_price' => 'required|numeric|min:0',
            'lines.*.tax_id' => 'nullable|exists:taxes,id',
        ];
    }

    protected $messages = [
        'lines.min' => 'At least one item is required.',
        'lines.*.name.required' => 'Item name is required.',
    ];

    public function mount()
    {
        $this->bill_date = now()->format('Y-m-d');
        $this->bill_number = 'BILL-' . now()->format('Ymd-His');
        $this->addLine();
    }

    public function addLine()
    {
        $this->lines[] = [
            'name' => '',
            'item_id' => null,
            'quantity' => 1,
            'unit_price' => 0,
            'tax_id' => null,
            'total_price' => 0,
        ];
    }

    public function removeLine($index)
    {
        unset($this->lines[$index]);
        $this->lines = array_values($this->lines);
        $this->calculateTotals();
    }

    // === ITEM SEARCH & CREATE ===
    public function searchItems($query, $lineIndex)
    {
        $this->selectedLineIndex = $lineIndex;
        $this->itemSearch = $query;

        if (strlen($query) < 2) {
            $this->itemResults = [];
            $this->showItemDropdown = false;
            return;
        }

        $companyId = auth()->user()->company_id ?? 1;

        $this->itemResults = Item::where('company_id', $companyId)
            ->where('name', 'like', "%{$query}%")
            ->limit(8)
            ->get(['id', 'name', 'unit_price'])
            ->toArray();

        $this->showItemDropdown = true;
    }

    public function selectItem($itemId, $lineIndex)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        $this->lines[$lineIndex]['item_id'] = $item->id;
        $this->lines[$lineIndex]['name'] = $item->name;
        $this->lines[$lineIndex]['unit_price'] = $item->unit_price ?? 0;

        $this->closeItemDropdown();
        $this->calculateTotals();
    }

    public function createNewItem($lineIndex)
    {
        $name = trim($this->lines[$lineIndex]['name'] ?? '');
        if (empty($name)) return;

        $companyId = auth()->user()->company_id ?? 1;

        $exists = Item::where('company_id', $companyId)
            ->where('name', $name)
            ->exists();

        if ($exists) {
            $this->addError("lines.{$lineIndex}.name", "Item '$name' already exists.");
            return;
        }

        $newItem = Item::create([
            'name' => $name,
            'type' => 'product',
            'description' => '',
            'unit' => '',
            'unit_price' => $this->lines[$lineIndex]['unit_price'] ?? 0,
            'reorder_level' => 0,
            'company_id' => $companyId,
            'slug' => Str::slug($name . '-' . now()->format('YmdHis')),
        ]);

        $this->lines[$lineIndex]['item_id'] = $newItem->id;
        $this->closeItemDropdown();
        $this->calculateTotals();
    }

    public function closeItemDropdown()
    {
        $this->showItemDropdown = false;
        $this->itemSearch = '';
        $this->itemResults = [];
    }

    // === CALCULATE TOTALS ===
    public function updated($property)
    {
        if (str_starts_with($property, 'lines')) {
            $this->calculateTotals();
        }
    }

    public function calculateTotals()
    {
        $total = 0;
        foreach ($this->lines as $index => $line) {
            $qty = $line['quantity'] ?? 0;
            $price = $line['unit_price'] ?? 0;
            $subtotal = $qty * $price;

            $taxAmount = 0;
            if (!empty($line['tax_id'])) {
                $tax = Tax::find($line['tax_id']);
                $taxAmount = $subtotal * ($tax->rate ?? 0) / 100;
            }

            $lineTotal = $subtotal + $taxAmount;
            $this->lines[$index]['total_price'] = $lineTotal;
            $total += $lineTotal;
        }
        $this->total_price = $total;
    }

    // === SAVE ===
    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $bill = Bill::create([
                'bill_date' => $this->bill_date,
                'bill_number' => $this->bill_number,
                'entered_by' => auth()->id(),
                'project_id' => $this->project_id ?: null,
                'company_id' => auth()->user()->company_id ?? 1,
                'vendor_id' => $this->vendor_id,
                'status' => $this->status,
                'total_price' => $this->total_price,
                'notes' => $this->notes,
                'slug' => Str::slug($this->bill_number),
            ]);

            foreach ($this->lines as $index => $line) {
                $item = Item::find($line['item_id']);
                if (!$item) continue;

                $subtotal = $line['quantity'] * $line['unit_price'];
                $taxAmount = 0;
                if (!empty($line['tax_id'])) {
                    $tax = Tax::find($line['tax_id']);
                    $taxAmount = $subtotal * ($tax->rate ?? 0) / 100;
                }
                $lineTotal = $subtotal + $taxAmount;

                BillProduct::create([
                    'bill_id' => $bill->id,
                    'item_id' => $item->id,
                    'tax_id' => $line['tax_id'] ?? null,
                    'quantity' => $line['quantity'],
                    'unit_price' => $line['unit_price'],
                    'total_price' => $lineTotal,
                    'slug' => Str::slug("{$item->name}-{$bill->bill_number}-{$index}"),
                ]);

                StockMovement::create([
                    'type' => 'in',
                    'item_id' => $item->id,
                    'quantity' => $line['quantity'],
                    'unit_cost' => $line['unit_price'],
                    'date' => $this->bill_date,
                    'entered_by' => auth()->id(),
                    'project_id' => $this->project_id ?: null,
                    'company_id' => $bill->company_id,
                    'vendor_id' => $this->vendor_id,
                    'status' => 'completed',
                    'slug' => Str::slug("in-{$item->name}-" . now()->format('YmdHis')),
                ]);

                Stock::updateOrCreate(
                    [
                        'item_id' => $item->id,
                        'project_id' => $this->project_id ?: null,
                        'company_id' => $bill->company_id,
                    ],
                    ['stock' => DB::raw('stock + ' . $line['quantity'])]
                );
            }
        });

        session()->flash('message', 'Bill created successfully!');
        return redirect()->route('bill.index');
    }

    public function render()
    {
        return view('livewire.bill.create', [
            'vendors' => Vendor::orderBy('name')->get(),
            'taxes' => Tax::orderBy('name')->get(),
            'projects' => Project::orderBy('name')->get(),
        ]);
    }
}