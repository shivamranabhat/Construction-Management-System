<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Vendor;
use App\Models\Project;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Edit extends Component
{
    public $slug;

    public $vendor_id = '';
    public $project_id = '';
    public $bill_number;
    public $bill_date;
    public $due_date;
    public $notes;

    public $items = [];
    public $subtotal = 0;
    public $tax = 0;
    public $total = 0;

    public $vendors;
    public $projects;

    public function mount($slug)
    {
        $this->slug = $slug;

        $this->vendors = Vendor::orderBy('name')->get();
        $this->projects = Project::orderBy('name')->get();

        $this->loadBill();
    }

    public function loadBill()
    {
        $bill = Bill::with(['items.item', 'items.tax'])->whereSlug( $this->slug)->firstOrFail();

        $this->vendor_id    = $bill->vendor_id;
        $this->project_id   = $bill->project_id === null ? 'global' : $bill->project_id;
        $this->bill_number  = $bill->bill_number;
        $this->bill_date    = Carbon::parse($bill->bill_date)->format('Y-m-d');
        $this->due_date     = Carbon::parse($bill->due_date)->format('Y-m-d');
        $this->notes        = $bill->notes;

        $this->items = $bill->items->map(function ($bi) {
            return [
                'bill_item_id' => $bi->id,
                'item_id'      => $bi->item_id,
                'item_name'    => $bi->item->name,
                'quantity'     => $bi->quantity,
                'unit_price'   => $bi->unit_price,
                'tax_id'       => $bi->tax_id,
                'tax_rate'     => $bi->tax?->rate ?? 0,
                'total'        => $bi->quantity * $bi->unit_price,
            ];
        })->toArray();

        $this->recalculate();
    }

    public function updated($field)
    {
        if (str_starts_with($field, 'items.')) {
            $this->recalculate();
        }
    }

    public function recalculate()
    {
        $subtotal = collect($this->items)->sum('total');
        $this->subtotal = $subtotal;
        $this->tax = collect($this->items)->sum(fn($i) => $i['total'] * ($i['tax_rate'] / 100));
        $this->total = $subtotal + $this->tax;
    }

  

    public function update()
    {
        $this->validate([
            'bill_date' => 'required|date',
            'due_date'  => 'required|date|after_or_equal:bill_date',
            'items'     => 'array|min:1',
            'items.*.quantity'   => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.item_name'  => 'required|string',
        ]);

        DB::transaction(function () {
            $bill = Bill::whereSlug($this->slug)->firstOrFail();

            // Update main bill fields
            $bill->update([
                'bill_date' => $this->bill_date,
                'due_date'  => $this->due_date,
                'subtotal'  => $this->subtotal,
                'tax'       => $this->tax,
                'total'     => $this->total,
                'notes'     => $this->notes,
            ]);

            // Sync Bill Items
            $existingIds = collect($this->items)
                ->filter(fn($i) => !empty($i['bill_item_id']))
                ->pluck('bill_item_id');

            // Delete removed items
            BillItem::where('bill_id', $bill->id)
                ->whereNotIn('id', $existingIds)
                ->delete();

            foreach ($this->items as $item) {
                $data = [
                    'item_id'     => $item['item_id'],
                    'quantity'    => $item['quantity'],
                    'unit_price'  => $item['unit_price'],
                    'tax_id'      => $item['tax_id'],
                    'total'       => $item['quantity'] * $item['unit_price'],
                ];

                if (!empty($item['bill_item_id'])) {
                    // Update existing
                    BillItem::where('id', $item['bill_item_id'])
                        ->update($data);
                } else {
                    // Create new
                    BillItem::create(array_merge($data, [
                        'bill_id' => $bill->id,
                        'item_id' => $item['item_id'] ?? null,
                    ]));
                }
            }

            $this->dispatch('toast', [
                'title'   => 'Bill Updated!',
                'message' => "Bill #{$bill->bill_number} has been updated.",
                'type'    => 'success'
            ]);

            return redirect()->route('bill.index');
        });
    }

    public function render()
    {
        return view('livewire.bill.edit');
    }
}