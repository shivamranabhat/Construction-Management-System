<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Item;
use App\Models\Category;
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
    public $purchase_date;
    public $purchase_number;
    public $vendor_id = '';
    public $project_id = '';
    public $status = 'draft';
    public $notes = '';
    public $customer_notes = '';

    public $sub_total = 0;
    public $tax_total = 0;
    public $grand_total = 0;

    public $lines = [];

    // Dropdown
    public $showItemDropdown = [];
    public $item_search = [];

    public $vendors, $taxes, $projects, $categories;

    public function mount()
    {
        $this->purchase_date = now()->format('Y-m-d');
        $this->purchase_number = 'PO-' . now()->format('Ymd-His');
        $this->loadSelects();
        $this->addEmptyRow();
    }

    public function loadSelects()
    {
        $companyId = auth()->user()->company_id ?? 1;
        $this->vendors = Vendor::where('company_id', $companyId)->orderBy('name')->get();
        $this->taxes = Tax::where('company_id', $companyId)->orderBy('name')->get();
        $this->projects = Project::where('company_id', $companyId)->orderBy('name')->get();
        $this->categories = Category::where('company_id', $companyId)->orderBy('name')->get();
    }

    public function addEmptyRow()
    {
        $index = count($this->lines);
        $this->lines[] = [
            'item_id' => null,
            'item_name' => '',
            'quantity' => 1,
            'rate' => 0,
            'tax_id' => null,
            'amount' => 0,
        ];
        $this->showItemDropdown[$index] = false;
        $this->item_search[$index] = '';
        $this->calculateTotals();
    }

    public function removeLine($index)
    {
        unset($this->lines[$index]);
        unset($this->showItemDropdown[$index]);
        unset($this->item_search[$index]);
        $this->lines = array_values($this->lines);
        $this->calculateTotals();
    }

    public function updatedLines($value, $key)
    {
        preg_match('/^(\d+)\.(.+)$/', $key, $matches);
        if (!$matches) return;

        [$_, $index, $field] = $matches;

        if ($field === 'item_name') {
            $typed = trim($value);
            $this->showItemDropdown[$index] = strlen($typed) > 0;
            $this->item_search[$index] = $typed;
            $this->lines[$index]['item_id'] = null;
        }

        $this->calculateLineAmount($index);
        $this->calculateTotals();
    }

    public function calculateLineAmount($index)
    {
        $line = &$this->lines[$index];
        $qty = (float) ($line['quantity'] ?? 0);
        $rate = (float) ($line['rate'] ?? 0);
        $taxRate = 0;

        if (!empty($line['tax_id'])) {
            $tax = Tax::find($line['tax_id']);
            $taxRate = $tax?->rate ?? 0;
        }

        $line['amount'] = $qty * $rate * (1 + $taxRate / 100);
    }

    public function calculateTotals()
    {
        $this->sub_total = 0;
        $this->tax_total = 0;

        foreach ($this->lines as $line) {
            $qty = (float) ($line['quantity'] ?? 0);
            $rate = (float) ($line['rate'] ?? 0);
            $taxRate = 0;

            if (!empty($line['tax_id'])) {
                $tax = Tax::find($line['tax_id']);
                $taxRate = $tax?->rate ?? 0;
            }

            $line_sub = $qty * $rate;
            $line_tax = $line_sub * ($taxRate / 100);

            $this->sub_total += $line_sub;
            $this->tax_total += $line_tax;
        }

        $this->grand_total = $this->sub_total + $this->tax_total;
    }

    public function selectItem($index, $itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        $this->lines[$index] = [
            'item_id'   => $item->id,
            'item_name' => $item->name,
            'quantity'  => $this->lines[$index]['quantity'] ?? 1,
            'rate'      => $this->lines[$index]['rate'] ?? ($item->cost_price ?? 0),
            'tax_id'    => $this->lines[$index]['tax_id'] ?? null,
            'amount'    => 0,
        ];

        unset($this->showItemDropdown[$index]);
        unset($this->item_search[$index]);

        $this->calculateLineAmount($index);
        $this->calculateTotals();
    }

    public function openAddItemModal($index)
    {
        $this->dispatch('open-add-item-modal', [
            'index' => $index,
            'name'  => $this->lines[$index]['item_name'] ?? ''
        ]);

        unset($this->showItemDropdown[$index]);
    }

    public function closeAllDropdowns()
    {
        $this->showItemDropdown = [];
        $this->item_search = [];
    }

    public function save()
    {
        $this->validate([
            'purchase_date' => 'required|date',
            'purchase_number' => 'required|string',
            'vendor_id' => 'required|exists:vendors,id',
            'project_id' => 'required|exists:projects,id',
            'lines' => 'required|array|min:1',
            'lines.*.quantity' => 'required|integer|min:1',
            'lines.*.rate' => 'required|numeric|min:0',
        ]);

        $companyId = auth()->user()->company_id ?? 1;
        $userId = auth()->id();

        DB::transaction(function () use ($companyId, $userId) {
            $purchase = Purchase::create([
                'purchase_date' => $this->purchase_date,
                'purchase_number' => $this->purchase_number,
                'vendor_id' => $this->vendor_id,
                'project_id' => $this->project_id ?: null,
                'entered_by' => $userId,
                'company_id' => $companyId,
                'total_price' => $this->grand_total,
                'status' => $this->status,
                'notes' => $this->notes,
                'slug' => Str::slug($this->purchase_number),
            ]);

            foreach ($this->lines as $i => $line) {
                $item = $line['item_id'] ? Item::find($line['item_id']) : null;

                if (!$item && $line['item_name']) {
                    $item = Item::create([
                        'name' => $line['item_name'],
                        'type' => 'Product',
                        'unit' => 'pcs',
                        'reorder_level' => 0,
                        'company_id' => $companyId,
                        'slug' => Str::slug($line['item_name'] . '-' . now()->format('YmdHis')),
                    ]);
                }

                if (!$item) continue;

                $subtotal = $line['quantity'] * $line['rate'];
                $taxAmount = $line['tax_id'] ? $subtotal * (Tax::find($line['tax_id'])?->rate ?? 0) / 100 : 0;
                $lineTotal = $subtotal + $taxAmount;

                foreach ($this->lines as $i => $line) {
                    $this->validate([
                        "lines.$i.quantity" => 'required|numeric|min:1',
                        "lines.$i.rate" => 'required|numeric|min:0',
                        "lines.$i.tax_id" => 'nullable|exists:taxes,id', // ← allows null
                    ]);
                }
                $purchaseProduct = PurchaseProduct::create([
                    'purchase_id' => $purchase->id,
                    'item_id' => $item->id,
                    'tax_id' => $line['tax_id'] ?? null,
                    'quantity' => $line['quantity'],
                    'unit_price' => $line['rate'],
                    'total_price' => $lineTotal,
                    'company_id' => $companyId,
                    'entered_by' => $userId,
                    'updated_by' => $userId,
                    'slug' => Str::slug("{$item->name}-{$purchase->purchase_number}-{$i}"),
                ]);

                StockMovement::create([
                    'purchase_product_id' => $purchaseProduct->id,
                    'type' => 'in',
                    'item_id' => $item->id,
                    'quantity' => $line['quantity'],
                    'unit_cost' => $line['rate'],
                    'date' => $this->purchase_date,
                    'entered_by' => $userId,
                    'project_id' => $this->project_id ?: null,
                    'company_id' => $companyId,
                    'vendor_id' => $this->vendor_id,
                    'status' => 'completed',
                    'updated_by' => $userId,
                    'slug' => Str::slug("in-po-{$item->name}-" . now()->format('YmdHis')),
                ]);
                // -----------------------------------------------------------------
                // 3. **UPDATE / CREATE** Stock record
                // -----------------------------------------------------------------
                $stock = Stock::where('company_id', $companyId)
                    ->where('project_id', $this->project_id ?: null)
                    ->where('item_id', $item->id)
                    ->first();

                if ($stock) {
                    // Existing row → just add the new quantity
                    $stock->increment('stock', $line['quantity']);
                } else {
                    // No row yet → create it
                    Stock::create([
                        'item_id'    => $item->id,
                        'stock'      => $line['quantity'],
                        'project_id' => $this->project_id ?: null,
                        'company_id' => $companyId,
                        'slug'       => Str::slug("stock-{$item->name}-{$companyId}-{$this->project_id}"),
                    ]);
                }

            }
        });

        session()->flash('message', 'Purchase created!');
        return redirect()->route('purchase.index');
    }

    public function render()
    {
        return view('livewire.purchase.create');
    }
}