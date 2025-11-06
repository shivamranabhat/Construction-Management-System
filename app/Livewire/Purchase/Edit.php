<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $purchase;
    public $purchase_date, $purchase_number, $vendor_id, $project_id, $status, $notes, $total_price;
    public $lines = [];

    public $vendors, $taxes, $projects;

    public function mount(Purchase $purchase)
    {
        $this->purchase = $purchase;

        $this->purchase_date = $purchase->purchase_date->format('Y-m-d');
        $this->purchase_number = $purchase->purchase_number;
        $this->vendor_id = $purchase->vendor_id;
        $this->project_id = $purchase->project_id;
        $this->status = $purchase->status;
        $this->notes = $purchase->notes;

        $this->lines = $purchase->products->map(fn($p) => [
            'name' => $p->item->name,
            'item_id' => $p->item_id,
            'quantity' => $p->quantity,
            'unit_price' => $p->unit_price,
            'tax_id' => $p->tax_id,
            'total_price' => $p->total_price,
            'original_quantity' => $p->quantity,
        ])->toArray();

        $this->loadSelects();
        $this->calculateTotals();
    }

    public function loadSelects()
    {
        $companyId = auth()->user()->company_id ?? 1;
        $this->vendors = \App\Models\Vendor::where('company_id', $companyId)->get();
        $this->taxes = Tax::where('company_id', $companyId)->get();
        $this->projects = \App\Models\Project::where('company_id', $companyId)->get();
    }

    public function updated($property)
    {
        if (str_starts_with($property, 'lines')) $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $total = 0;
        foreach ($this->lines as $i => $line) {
            $subtotal = ($line['quantity'] ?? 0) * ($line['unit_price'] ?? 0);
            $tax = $line['tax_id'] ? Tax::find($line['tax_id'])?->rate ?? 0 : 0;
            $lineTotal = $subtotal + ($subtotal * $tax / 100);
            $this->lines[$i]['total_price'] = $lineTotal;
            $total += $lineTotal;
        }
        $this->total_price = $total;
    }

    public function removeLine($index)
    {
        unset($this->lines[$index]);
        $this->lines = array_values($this->lines);
        $this->calculateTotals();
    }

    public function save()
    {
        $this->validate([
            'purchase_date' => 'required|date',
            'purchase_number' => 'required|string|unique:purchases,purchase_number,' . $this->purchase->id,
            'vendor_id' => 'required|exists:vendors,id',
            'lines' => 'required|array|min:1',
            'lines.*.quantity' => 'required|integer|min:1',
            'lines.*.unit_price' => 'required|numeric|min:0',
        ]);

        $companyId = auth()->user()->company_id ?? 1;
        $userId = auth()->id();

        DB::transaction(function () use ($companyId, $userId) {
            $this->purchase->update([
                'purchase_date' => $this->purchase_date,
                'purchase_number' => $this->purchase_number,
                'vendor_id' => $this->vendor_id,
                'project_id' => $this->project_id ?: null,
                'status' => $this->status,
                'notes' => $this->notes,
                'total_price' => $this->total_price,
                'updated_by' => $userId,
            ]);

            $oldProducts = $this->purchase->products()->pluck('quantity', 'item_id');
            $this->purchase->products()->delete();

            foreach ($this->lines as $i => $line) {
                $item = \App\Models\Item::find($line['item_id']);
                $subtotal = $line['quantity'] * $line['unit_price'];
                $taxAmount = $line['tax_id'] ? $subtotal * (Tax::find($line['tax_id'])?->rate ?? 0) / 100 : 0;
                $lineTotal = $subtotal + $taxAmount;

                PurchaseProduct::create([
                    'purchase_id' => $this->purchase->id,
                    'item_id' => $item->id,
                    'tax_id' => $line['tax_id'] ?? null,
                    'quantity' => $line['quantity'],
                    'unit_price' => $line['unit_price'],
                    'total_price' => $lineTotal,
                    'company_id' => $companyId,
                    'entered_by' => $this->purchase->entered_by,
                    'updated_by' => $userId,
                    'slug' => Str::slug("{$item->name}-{$this->purchase->purchase_number}-{$i}"),
                ]);

                $oldQty = $oldProducts[$item->id] ?? 0;
                $delta = $line['quantity'] - $oldQty;

                if ($delta != 0) {
                    StockMovement::create([
                        'type' => $delta > 0 ? 'in' : 'out',
                        'item_id' => $item->id,
                        'quantity' => abs($delta),
                        'unit_cost' => $line['unit_price'],
                        'date' => $this->purchase_date,
                        'entered_by' => $userId,
                        'project_id' => $this->project_id ?: null,
                        'company_id' => $companyId,
                        'vendor_id' => $this->vendor_id,
                        'status' => 'completed',
                        'updated_by' => $userId,
                        'slug' => Str::slug("edit-po-{$item->name}-" . now()->format('YmdHis')),
                    ]);

                    Stock::updateOrCreate(
                        ['item_id' => $item->id, 'project_id' => $this->project_id ?: null, 'company_id' => $companyId],
                        ['stock' => DB::raw("stock + ($delta)")]
                    );
                }
            }
        });

        session()->flash('message', 'Purchase updated!');
        return redirect()->route('purchase.index');
    }

    public function render()
    {
        return view('livewire.purchase.edit');
    }
}