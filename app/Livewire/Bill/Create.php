<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Vendor;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $vendor_id = '';
    public $project_id = '';
    public $bill_number;
    public $bill_date;
    public $due_date;
    public $notes;

    public $items = []; // Livewire array
    public $subtotal = 0;
    public $tax = 0;
    public $total = 0;

    public $vendors;
    public $projects;

    public function mount()
    {
        $this->vendors = Vendor::orderBy('name')->get();
        $this->projects = Project::orderBy('name')->get();
        $this->bill_number = 'BILL-' . strtoupper(\Str::random(6));
        $this->bill_date = now()->format('Y-m-d');
        $this->due_date = now()->addDays(30)->format('Y-m-d');
    }

    public function updated($field)
    {
        if ($field === 'vendor_id' || $field === 'project_id') {
            $this->loadItemsFromPurchases();
        }
        if (str_starts_with($field, 'items.')) {
            $this->recalculate();
        }
    }

    public function loadItemsFromPurchases()
    {
        $this->items = [];

        if (!$this->vendor_id || $this->project_id === '') return;

        $projectId = $this->project_id === 'global' ? null : $this->project_id;

        $purchases = Purchase::with(['products.item', 'products.tax']) // Load tax via PurchaseProduct
            ->where('vendor_id', $this->vendor_id)
            ->where('project_id', $projectId)
            ->where('status', 'draft')
            ->get();

        foreach ($purchases as $purchase) {
            foreach ($purchase->products as $pp) {
                $this->items[] = [
                    'purchase_product_id' => $pp->id,
                    'item_id' => $pp->item_id,
                    'item_name' => $pp->item->name,
                    'quantity' => $pp->quantity,
                    'unit_price' => $pp->unit_price,
                    'tax_id' => $pp->tax_id,
                    'tax_rate' => $pp->tax?->rate ?? 0, // Use tax from PurchaseProduct
                    'total' => $pp->quantity * $pp->unit_price,
                ];
            }
        }

        $this->recalculate();
    }

    public function recalculate()
    {
        $subtotal = collect($this->items)->sum('total');
        $this->subtotal = $subtotal;
        $this->tax = collect($this->items)->sum(fn($i) => $i['total'] * ($i['tax_rate'] / 100));
        $this->total = $subtotal + $this->tax;
    }

    public function save()
{
    $this->validate([
        'vendor_id' => 'required',
        'project_id' => 'required',
        'bill_number' => 'required|unique:bills',
        'bill_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:bill_date',
        'items' => 'array|min:1',
        'items.*.quantity' => 'required|numeric|min:1',
        'items.*.unit_price' => 'required|numeric|min:0',
    ]);

    DB::transaction(function () {
        // === 1. Determine the Purchase ID (all items should come from same purchase) ===
        $firstItem = collect($this->items)->first();
        $purchaseId = null;

        if ($firstItem && !empty($firstItem['purchase_product_id'])) {
            $pp = PurchaseProduct::find($firstItem['purchase_product_id']);
            $purchaseId = $pp?->purchase_id;
        }

        // Optional: Validate all items belong to same purchase
        foreach ($this->items as $item) {
            if (!empty($item['purchase_product_id'])) {
                $pp = PurchaseProduct::find($item['purchase_product_id']);
                if ($pp && $pp->purchase_id !== $purchaseId) {
                    throw new \Exception('All bill items must belong to the same purchase.');
                }
            }
        }

        // === 2. Create Bill with purchase_id ===
        $bill = Bill::create([
            'vendor_id'    => $this->vendor_id,
            'project_id'   => $this->project_id === 'global' ? null : $this->project_id,
            'company_id'   => auth()->user()->company_id,
            'purchase_id'  => $purchaseId, // ← HERE
            'bill_number'  => $this->bill_number,
            'bill_date'    => $this->bill_date,
            'due_date'     => $this->due_date,
            'subtotal'     => $this->subtotal,
            'tax'          => $this->tax,
            'total'        => $this->total,
            'notes'        => $this->notes,
            'status'       => 'draft',
        ]);

        // === 3. Create Bill Items ===
        $purchaseIdsToBill = collect(); // To update status later

        foreach ($this->items as $item) {
            $billItem = BillItem::create([
                'bill_id'             => $bill->id,
                'item_id'             => $item['item_id'],
                'quantity'            => $item['quantity'],
                'unit_price'          => $item['unit_price'],
                'tax_id'              => $item['tax_id'],
                'total'               => $item['quantity'] * $item['unit_price'],
                'purchase_product_id' => $item['purchase_product_id'] ?? null,
            ]);

            if (!empty($item['purchase_product_id'])) {
                $pp = PurchaseProduct::find($item['purchase_product_id']);
                if ($pp) {
                    $purchaseIdsToBill->push($pp->purchase_id);
                }
            }
        }

        // === 4. Mark related Purchases as 'billed' ===
        if ($purchaseIdsToBill->isNotEmpty()) {
            Purchase::whereIn('id', $purchaseIdsToBill->unique())
                ->update(['status' => 'billed']);
        }

        // === 5. Generate slug (if using) ===
        if (method_exists($bill, 'refreshSlug')) {
            $bill->refreshSlug();
        }


        return redirect()->route('bill.index');
    });
}
    public function render()
    {
        return view('livewire.bill.create');
    }
}