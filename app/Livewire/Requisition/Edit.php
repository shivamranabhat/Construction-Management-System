<?php

namespace App\Livewire\Requisition;

use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\Item;
use Livewire\Component;

class Edit extends Component
{
    public $requisition;
    public $project_id;
    public $required_date;
    public $purpose;
    public $items = [];

    public function mount(Requisition $requisition)
    {
        $this->authorize('update', $requisition); // optional policy

        $this->requisition = $requisition;
        $this->project_id = $requisition->project_id;
        $this->required_date = $requisition->required_date->format('Y-m-d');
        $this->purpose = $requisition->purpose;

        foreach ($requisition->items as $item) {
            $this->items[] = [
                'id' => $item->id,
                'item_id' => $item->item_id,
                'quantity' => $item->quantity,
                'unit' => $item->unit,
                'remarks' => $item->remarks,
            ];
        }
    }

    public function addItemRow()
    {
        $this->items[] = ['item_id' => '', 'quantity' => 1, 'unit' => 'nos', 'remarks' => ''];
    }

    public function removeItemRow($index)
    {
        $itemId = $this->items[$index]['id'] ?? null;
        if ($itemId) {
            RequisitionItem::find($itemId)->delete();
        }
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function save()
    {
        $this->validate([
            'project_id' => 'required',
            'required_date' => 'required|date|after:today',
            'purpose' => 'required',
            'items.*.item_id' => 'required',
            'items.*.quantity' => 'required|numeric|min:0.01',
        ]);

        $this->requisition->update([
            'project_id' => $this->project_id,
            'required_date' => $this->required_date,
            'purpose' => $this->purpose,
        ]);

        // Sync items
        $existingIds = [];
        foreach ($this->items as $itemData) {
            $data = [
                'item_id' => $itemData['item_id'],
                'quantity' => $itemData['quantity'],
                'unit' => $itemData['unit'],
                'remarks' => $itemData['remarks'] ?? null,
            ];

            if (isset($itemData['id'])) {
                $item = RequisitionItem::find($itemData['id']);
                $item->update($data);
                $existingIds[] = $item->id;
            } else {
                $newItem = RequisitionItem::create(array_merge($data, [
                    'requisition_id' => $this->requisition->id,
                ]));
                $existingIds[] = $newItem->id;
            }
        }

        // Delete removed
        RequisitionItem::where('requisition_id', $this->requisition->id)
            ->whereNotIn('id', $existingIds)
            ->delete();

        $this->dispatch('toast', ['title' => 'Updated!', 'type' => 'success']);
        return redirect()->route('requisition.index');
    }

    public function render()
    {
        $companyId = auth()->user()->company_id;
        $availableItems = Item::where('company_id', $companyId)
            ->pluck('name', 'id');

        return view('livewire.requisition.edit', compact('availableItems'));
    }
}