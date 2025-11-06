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

class Edit extends Create // Inherits shared logic: addLine, removeLine, updatedLines, calculateTotals
{
    public $bill;
    public $showDeleteModal = false;

    public function mount($bill = null)
    {
        $this->bill = Bill::with(['products.item', 'products.tax'])->findOrFail($bill);

        $this->bill_date = $this->bill->bill_date->format('Y-m-d');
        $this->bill_number = $this->bill->bill_number;
        $this->vendor_id = $this->bill->vendor_id;
        $this->project_id = $this->bill->project_id ?? '';
        $this->status = $this->bill->status;
        $this->notes = $this->bill->notes;
        $this->total_price = $this->bill->total_price;

        $this->lines = $this->bill->products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->item?->name ?? '',
                'item_id' => $product->item_id,
                'tax_id' => $product->tax_id,
                'quantity' => $product->quantity,
                'unit_price' => $product->unit_price,
                'total_price' => $product->total_price,
            ];
        })->toArray();

        // Allow same bill_number
        $this->rules['bill_number'] = 'required|string|unique:bills,bill_number,' . $this->bill->id;
    }

    public function updatedLines($value, $key)
    {
        parent::updatedLines(...func_get_args());
        $this->calculateTotals();
    }

    public function updated($property)
    {
        $this->validateOnly($property);
        if (str_starts_with($property, 'lines')) {
            $this->calculateTotals();
        }
    }

    public function calculateTotals()
    {
        $total = 0;
        foreach ($this->lines as $index => $line) {
            $subtotal = ($line['quantity'] ?? 0) * ($line['unit_price'] ?? 0);
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

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            // 1. Update Bill Header
            $this->bill->update([
                'bill_date' => $this->bill_date,
                'bill_number' => $this->bill_number,
                'vendor_id' => $this->vendor_id,
                'project_id' => $this->project_id ?: null,
                'status' => $this->status,
                'notes' => $this->notes,
                'total_price' => $this->total_price,
                'slug' => Str::slug($this->bill_number),
            ]);

            // 2. Track Old Quantities
            $oldQuantities = [];
            foreach ($this->bill->products as $oldProduct) {
                $key = $oldProduct->item_id . '-' . ($this->project_id ?: 'null');
                $oldQuantities[$key] = ($oldQuantities[$key] ?? 0) + $oldProduct->quantity;
            }

            // 3. Delete Old Bill Products
            $this->bill->products()->delete();

            // 4. Create New Bill Products + Stock Movements
            $newQuantities = [];
            foreach ($this->lines as $index => $lineData) {
                // Resolve or create Item
                $item = Item::find($lineData['item_id']);
                if (!$item && !empty($lineData['name'])) {
                    $item = Item::create([
                        'name' => $lineData['name'],
                        'type' => 'product',
                        'description' => '',
                        'unit' => '',
                        'reorder_level' => 0,
                        'company_id' => auth()->user()->company_id ?? 1,
                        'slug' => Str::slug($lineData['name']),
                    ]);
                    $lineData['item_id'] = $item->id;
                    $this->lines[$index]['item_id'] = $item->id;
                }

                if (!$item) continue;

                $subtotal = $lineData['quantity'] * $lineData['unit_price'];
                $taxAmount = 0;
                if (!empty($lineData['tax_id'])) {
                    $tax = Tax::find($lineData['tax_id']);
                    $taxAmount = $subtotal * ($tax->rate ?? 0) / 100;
                }
                $lineTotal = $subtotal + $taxAmount;

                BillProduct::create([
                    'bill_id' => $this->bill->id,
                    'item_id' => $item->id,
                    'tax_id' => $lineData['tax_id'] ?? null,
                    'quantity' => $lineData['quantity'],
                    'unit_price' => $lineData['unit_price'],
                    'total_price' => $lineTotal,
                    'slug' => Str::slug("{$item->name}-{$this->bill->bill_number}-{$index}"),
                ]);

                $key = $item->id . '-' . ($this->project_id ?: 'null');
                $newQuantities[$key] = ($newQuantities[$key] ?? 0) + $lineData['quantity'];

                StockMovement::create([
                    'type' => 'in',
                    'item_id' => $item->id,
                    'quantity' => $lineData['quantity'],
                    'unit_cost' => $lineData['unit_price'],
                    'date' => $this->bill_date,
                    'entered_by' => auth()->id(),
                    'project_id' => $this->project_id ?: null,
                    'company_id' => $this->bill->company_id,
                    'vendor_id' => $this->vendor_id,
                    'status' => 'completed',
                    'slug' => Str::slug("in-edit-{$item->name}-" . now()->format('YmdHis') . "-{$index}"),
                ]);
            }

            // 5. Adjust Stock (Delta)
            $allKeys = array_unique(array_merge(array_keys($oldQuantities), array_keys($newQuantities)));
            foreach ($allKeys as $key) {
                [$itemId, $projId] = explode('-', $key);
                $projId = $projId === 'null' ? null : $projId;

                $old = $oldQuantities[$key] ?? 0;
                $new = $newQuantities[$key] ?? 0;
                $delta = $new - $old;

                if ($delta === 0) continue;

                $stock = Stock::firstOrCreate(
                    ['item_id' => $itemId, 'project_id' => $projId, 'company_id' => $this->bill->company_id],
                    ['stock' => 0, 'slug' => Str::slug("stock-{$itemId}-{$projId}")]
                );

                $delta > 0 ? $stock->increment('stock', $delta) : $stock->decrement('stock', abs($delta));
            }
        });

        session()->flash('message', 'Bill updated successfully!');
        return redirect()->route('bills.index');
    }

    public function confirmDelete()
    {
        $this->showDeleteModal = true;
    }

    public function deleteBill()
    {
        DB::transaction(function () {
            // Reverse stock
            foreach ($this->bill->products as $product) {
                $stock = Stock::where('item_id', $product->item_id)
                    ->where('project_id', $this->project_id ?: null)
                    ->where('company_id', $this->bill->company_id)
                    ->first();

                if ($stock && $stock->stock >= $product->quantity) {
                    $stock->decrement('stock', $product->quantity);
                }
            }

            $this->bill->products()->delete();
            $this->bill->delete();
        });

        $this->showDeleteModal = false;
        session()->flash('message', 'Bill deleted successfully!');
        return redirect()->route('bills.index');
    }

    public function render()
    {
        $vendors = Vendor::all();
        $taxes = Tax::all();
        $projects = Project::all();

        return view('livewire.bill.edit', compact('vendors', 'taxes', 'projects'));
    }
}