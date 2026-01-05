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
use App\Models\Requisition;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
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
    public $userProjects = [];
    public $singleProject = false;
    public $noProjectAccess = false;

    // Requisition Modal
    public $pendingRequisitions = [];
    public $showRequisitionModal = false;
    public $selectedRequisitionId = null;

    public function mount()
    {
        $this->purchase_date = now()->format('Y-m-d');
        $this->purchase_number = 'PO-' . now()->format('Ymd-His');

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

        $this->loadSelects();
        $this->addEmptyRow();
    }

    public function loadSelects()
    {
        $companyId = auth()->user()->company_id;
        $this->vendors = Vendor::where('company_id', $companyId)->orderBy('name')->get();
        $this->taxes = Tax::where('company_id', $companyId)->orderBy('name')->get();
        $this->categories = Category::where('company_id', $companyId)->orderBy('name')->get();
    }

    public function updatedVendorId() { $this->checkForRequisitions(); }
    public function updatedProjectId() { $this->checkForRequisitions(); }

    public function checkForRequisitions()
    {
        if (!$this->vendor_id || !$this->project_id) {
            $this->pendingRequisitions = [];
            $this->showRequisitionModal = false;
            return;
        }

        $this->pendingRequisitions = Requisition::with(['items.item', 'project'])
            ->where('vendor_id', $this->vendor_id)
            ->where('project_id', $this->project_id)
            ->where('status', 'owner_approved')
            ->whereDoesntHave('purchase')
            ->orderByDesc('created_at')
            ->get();

        $this->showRequisitionModal = $this->pendingRequisitions->isNotEmpty();
    }

    public function useRequisition($requisitionId)
    {
        $requisition = Requisition::with('items.item')->findOrFail($requisitionId);

        $this->lines = [];
        foreach ($requisition->items as $reqItem) {
            $this->lines[] = [
                'item_id'   => $reqItem->item_id,
                'item_name' => $reqItem->item->name,
                'quantity'  => $reqItem->quantity,
                'rate'      => 0,
                'tax_id'    => null,
                'amount'    => 0,
            ];
        }

        $this->selectedRequisitionId = $requisition->id;
        $this->calculateTotals();
        $this->showRequisitionModal = false;

        $this->dispatch('toast', type: 'success', 
            message: "Items loaded from #{$requisition->requisition_number}");
    }

    public function ignoreRequisitions()
    {
        $this->showRequisitionModal = false;
        $this->dispatch('toast', type: 'info', message: 'Continue manually');
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
            'lines.*.tax_id' => 'nullable|exists:taxes,id',
        ]);

        $companyId = auth()->user()->company_id;
        $userId = auth()->id();

        DB::transaction(function () use ($companyId, $userId) {
            $purchase = Purchase::create([
                'purchase_date' => $this->purchase_date,
                'purchase_number' => $this->purchase_number,
                'vendor_id' => $this->vendor_id,
                'project_id' => $this->project_id,
                'entered_by' => $userId,
                'company_id' => $companyId,
                'total_price' => $this->grand_total,
                'status' => $this->status,
                'notes' => $this->notes,
                'requisition_id' => $this->selectedRequisitionId,
                'slug' => Str::slug($this->purchase_number),
            ]);

            // Update requisition status if used
            if ($this->selectedRequisitionId) {
                Requisition::where('id', $this->selectedRequisitionId)
                    ->update(['status' => 'po_created']);
            }

            foreach ($this->lines as $index => $line) {
                $item = $line['item_id'] ? Item::find($line['item_id']) : null;

                if (!$item && !empty($line['item_name'])) {
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
                $taxAmount = $line['tax_id']
                    ? $subtotal * (Tax::find($line['tax_id'])?->rate ?? 0) / 100
                    : 0;
                $lineTotal = $subtotal + $taxAmount;

                // Generate unique slug for PurchaseProduct
                $productSlug = Str::slug("{$purchase->purchase_number}-{$item->name}-{$index}");

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
                    'slug' => $productSlug, // ← Added here
                ]);

                // Stock Movement
                StockMovement::create([
                    'purchase_product_id' => $purchaseProduct->id,
                    'type' => 'in',
                    'item_id' => $item->id,
                    'quantity' => $line['quantity'],
                    'unit_cost' => $line['rate'],
                    'date' => $this->purchase_date,
                    'entered_by' => $userId,
                    'project_id' => $this->project_id,
                    'company_id' => $companyId,
                    'vendor_id' => $this->vendor_id,
                    'status' => 'completed',
                    'slug' => Str::slug("in-po-{$item->name}-" . now()->format('YmdHis')),
                ]);

                // Update or Create Stock
                $stock = Stock::firstOrCreate(
                    [
                        'company_id' => $companyId,
                        'project_id' => $this->project_id,
                        'item_id' => $item->id,
                    ],
                    ['stock' => 0]
                );

                $stock->increment('stock', $line['quantity']);
            }
        });

       session()->flash('message', 'Purchase data stored successfully!');

        return redirect()->route('purchase.index');
    }


    public function render()
    {
        return view('livewire.purchase.create');
    }
}