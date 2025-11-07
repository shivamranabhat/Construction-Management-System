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
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public $purchase;
    public $purchase_date;
    public $purchase_number;
    public $vendor_id = '';
    public $project_id = '';
    public $status = 'draft';
    public $notes = '';

    public $sub_total = 0;
    public $tax_total = 0;
    public $grand_total = 0;

    public $lines = [];
    public $originalLines = []; // To detect deletions

    // Dropdown
    public $showItemDropdown = [];
    public $item_search = [];

    public $vendors, $taxes, $projects, $categories;

    public function mount($slug)
    {
        $this->purchase = Purchase::where('slug', $slug)->firstOrFail();
        $this->loadPurchaseData();
        $this->loadSelects();
    }

    public function loadPurchaseData()
    {
        $this->purchase_date = Carbon::parse($this->purchase->purchase_date)->format('Y-m-d');
        $this->purchase_number = $this->purchase->purchase_number;
        $this->vendor_id = $this->purchase->vendor_id;
        $this->project_id = $this->purchase->project_id;
        $this->status = $this->purchase->status;
        $this->notes = $this->purchase->notes;

        $this->loadLines();
        $this->calculateTotals();
    }

    public function loadLines()
    {
        $this->lines = [];
        $this->originalLines = [];

        foreach ($this->purchase->products as $i => $pp) {
            $this->lines[] = [
                'id' => $pp->id,
                'item_id' => $pp->item_id,
                'item_name' => $pp->item->name,
                'quantity' => $pp->quantity,
                'rate' => $pp->unit_price,
                'tax_id' => $pp->tax_id,
                'amount' => $pp->total_price,
            ];
            $this->originalLines[$pp->id] = $pp->id;
        }
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
            'id' => $this->lines[$index]['id'] ?? null,
            'item_id' => $item->id,
            'item_name' => $item->name,
            'quantity' => $this->lines[$index]['quantity'] ?? 1,
            'rate' => $this->lines[$index]['rate'] ?? ($item->cost_price ?? 0),
            'tax_id' => $this->lines[$index]['tax_id'] ?? null,
            'amount' => 0,
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

    public function save()
    {
        $this->validate([
            'purchase_date'   => 'required|date',
            'purchase_number' => 'required|string',
            'vendor_id'       => 'required|exists:vendors,id',
            'project_id'      => 'nullable|exists:projects,id',
            'lines'           => 'required|array|min:1',
            'lines.*.quantity'=> 'required|integer|min:1',
            'lines.*.rate'    => 'required|numeric|min:0',
            'lines.*.tax_id'  => 'nullable|exists:taxes,id',
        ]);

        $companyId = auth()->user()->company_id ?? 1;
        $userId    = auth()->id();

        DB::transaction(function () use ($companyId, $userId) {
            // ---- 1. Update Purchase header ---------------------------------
            $this->purchase->update([
                'purchase_date'   => $this->purchase_date,
                'purchase_number' => $this->purchase_number,
                'vendor_id'       => $this->vendor_id,
                'project_id'      => $this->project_id ?: null,
                'total_price'     => $this->grand_total,
                'status'          => $this->status,
                'notes'           => $this->notes,
                'updated_by'      => $userId,
                'slug'            => Str::slug($this->purchase_number),
            ]);

            // ---- 2. Prepare tracking ---------------------------------------
            $existingIds   = $this->purchase->products->pluck('id')->toArray();
            $updatedIds    = [];

            // ---- 3. Loop through lines --------------------------------------
            foreach ($this->lines as $i => $line) {
                // Resolve / create Item
                $item = $line['item_id'] ? Item::find($line['item_id']) : null;

                if (!$item && $line['item_name']) {
                    $item = Item::create([
                        'name'          => $line['item_name'],
                        'type'          => 'Product',
                        'unit'          => 'pcs',
                        'reorder_level' => 0,
                        'company_id'    => $companyId,
                        'slug'          => Str::slug($line['item_name'] . '-' . now()->format('YmdHis')),
                    ]);
                }
                if (!$item) continue;

                // ---- Tax handling ('' → null) ---------------------------
                $taxId = $line['tax_id'] ?? null;
                if ($taxId === '' || $taxId === '0') {
                    $taxId = null;
                }

                // ---- Line totals ----------------------------------------
                $subtotal  = $line['quantity'] * $line['rate'];
                $taxAmt    = $taxId ? $subtotal * (Tax::find($taxId)?->rate ?? 0) / 100 : 0;
                $lineTotal = $subtotal + $taxAmt;

                // ---- Common data ----------------------------------------
                $data = [
                    'purchase_id' => $this->purchase->id,
                    'item_id'     => $item->id,
                    'tax_id'      => $taxId,
                    'quantity'    => $line['quantity'],
                    'unit_price'  => $line['rate'],
                    'total_price' => $lineTotal,
                    'company_id'  => $companyId,
                    'entered_by'  => $line['id']
                        ? $this->purchase->products->find($line['id'])?->entered_by
                        : $userId,
                    'updated_by'  => $userId,
                    'slug'        => $this->generateUniqueSlug($item->name, $this->purchase->purchase_number, $i),
                ];

                // ---- UPDATE existing ----------------------------------------
                if (!empty($line['id']) && in_array($line['id'], $existingIds)) {
                    $pp = PurchaseProduct::find($line['id']);
                    $oldQty = $pp->quantity;
                    $pp->update($data);
                    $updatedIds[] = $line['id'];

                    $this->adjustStock($item->id, $oldQty, $line['quantity'], $this->project_id, $companyId);
                }
                // ---- CREATE new --------------------------------------------
                else {
                    $pp = PurchaseProduct::create($data);
                    $updatedIds[] = $pp->id;

                    $this->addToStock($item->id, $line['quantity'], $line['rate'], $this->project_id, $companyId, $userId);
                }

                // ---- StockMovement (always upsert) -------------------------
                StockMovement::updateOrCreate(
                    ['purchase_product_id' => $pp->id],
                    [
                        'type'        => 'in',
                        'item_id'     => $item->id,
                        'quantity'    => $line['quantity'],
                        'unit_cost'   => $line['rate'],
                        'date'        => $this->purchase_date,
                        'entered_by'  => $userId,
                        'project_id'  => $this->project_id ?: null,
                        'company_id'  => $companyId,
                        'vendor_id'   => $this->vendor_id,
                        'status'      => 'completed',
                        'updated_by'  => $userId,
                        'slug'        => Str::slug("in-po-{$item->name}-" . now()->format('YmdHis')),
                    ]
                );
            }

            // ---- 4. Delete removed lines -----------------------------------
            $deletedIds = array_diff($existingIds, $updatedIds);
            if ($deletedIds) {
                $deleted = PurchaseProduct::whereIn('id', $deletedIds)->get();
                foreach ($deleted as $pp) {
                    $this->removeFromStock($pp->item_id, $pp->quantity, $this->project_id, $companyId);
                    $pp->stockMovements()->delete();
                    $pp->delete();
                }
            }
        });

        session()->flash('message', 'Purchase updated successfully!');
        return redirect()->route('purchase.index');
    }

    protected function generateUniqueSlug($itemName, $poNumber, $index)
    {
        $base = Str::slug("{$itemName}-{$poNumber}-{$index}");
        $slug = $base;
        $i = 1;
        while (PurchaseProduct::where('slug', $slug)->where('purchase_id', '!=', $this->purchase->id)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }

    protected function addToStock($itemId, $quantity, $unitCost, $projectId, $companyId, $userId, $purchaseProductId)
    {
        Stock::updateOrCreate(
            [
                'item_id'    => $itemId,
                'project_id' => $projectId ?: null,
                'company_id' => $companyId,
            ],
            [
                'stock'               => DB::raw("stock + {$quantity}"),
                'average_cost'        => DB::raw(
                    "(COALESCE(stock,0) * COALESCE(average_cost,0) + ({$quantity} * {$unitCost})) / (COALESCE(stock,0) + {$quantity})"
                ),
                'purchase_product_id' => $purchaseProductId, 
                'slug'                => $this->generateStockSlug($itemId, $projectId),
            ]
        );
    }


    protected function adjustStock($itemId, $oldQty, $newQty, $projectId, $companyId)
    {
        $diff = $newQty - $oldQty;
        if ($diff == 0) return;

        $operator = $diff > 0 ? '+' : '-';
        $absDiff = abs($diff);

        Stock::where([
            'item_id' => $itemId,
            'project_id' => $projectId ?: null,
            'company_id' => $companyId,
        ])->increment('stock', $diff < 0 ? -$absDiff : $absDiff);
    }

    protected function removeFromStock($itemId, $quantity, $projectId, $companyId)
    {
        Stock::where([
            'item_id' => $itemId,
            'project_id' => $projectId ?: null,
            'company_id' => $companyId,
        ])->decrement('stock', $quantity);
    }

    protected function generateStockSlug($itemId, $projectId)
    {
        $item = Item::find($itemId);
        $base = Str::slug("stock-{$item->name}" . ($projectId ? "-proj-{$projectId}" : ""));
        $slug = $base;
        $i = 1;
        while (Stock::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }

    public function render()
    {
        return view('livewire.purchase.edit');
    }
}