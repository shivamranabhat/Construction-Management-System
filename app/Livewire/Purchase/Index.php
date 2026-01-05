<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status_filter = '';
    protected $queryString = ['search', 'status_filter'];
    public $perPage = 10;

    public function delete($slug)
    {
        // Direct deletion with transaction
        DB::transaction(function () use ($slug) {
            $purchase = Purchase::with(['products.item'])
                ->where('slug', $slug)
                ->firstOrFail();

            $companyId = $purchase->company_id;
            $projectId = $purchase->project_id; // may be null or 0

            // Reduce stock for each product
            foreach ($purchase->products as $pp) {
                $itemId   = $pp->item_id;
                $quantity = $pp->quantity;

                // Normalize project_id: treat 0 as null
                $effectiveProjectId = ($projectId === 0 || $projectId === null) ? null : $projectId;

                $q = Stock::withoutGlobalScopes()
                    ->where('item_id', $itemId)
                    ->where('company_id', $companyId);

                if ($effectiveProjectId !== null) {
                    $q->where('project_id', $effectiveProjectId);
                } else {
                    $q->whereNull('project_id');
                }


                try {
                    $affected = $q->decrement('stock', $quantity);
                } catch (\Exception $e) {
                    $affected = 0;
                }

                if ($affected === 0) {
                    $exists = Stock::withoutGlobalScopes()
                        ->where('item_id', $itemId)
                        ->where('company_id', $companyId)
                        ->where(function ($query) use ($effectiveProjectId) {
                            $effectiveProjectId === null
                                ? $query->whereNull('project_id')
                                : $query->where('project_id', $effectiveProjectId);
                        })
                        ->exists();
                 
                } else {
                }
            }

            // Delete pivot records and purchase
            $purchase->products()->delete();
            $purchase->delete();
        });

        session()->flash('success', 'Purchase data deleted successfully!');
    }

    public function render()
    {
        $purchases = Purchase::with(['vendor', 'project', 'enteredBy'])
            ->when($this->search, function ($q) {
                $q->where('purchase_number', 'like', "%{$this->search}%")
                ->orWhereHas('vendor', fn($query) => $query->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('project', fn($query) => $query->where('name', 'like', "%{$this->search}%"));
            })
            ->when($this->status_filter, fn($q) => $q->where('status', $this->status_filter))
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.purchase.index', compact('purchases'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
}