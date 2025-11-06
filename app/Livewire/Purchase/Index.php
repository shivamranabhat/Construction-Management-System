<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status_filter = '';

    protected $queryString = ['search', 'status_filter'];

    public function render()
    {
        $companyId = auth()->user()->company_id ?? 1;

        $purchases = Purchase::with(['vendor', 'project', 'enteredBy', 'updater'])
            ->where('company_id', $companyId)
            ->when($this->search, fn($q) => $q->where('purchase_number', 'like', "%{$this->search}%")
                ->orWhereHas('vendor', fn($q) => $q->where('name', 'like', "%{$this->search}%")))
            ->when($this->status_filter, fn($q) => $q->where('status', $this->status_filter))
            ->latest()
            ->paginate(12);

        return view('livewire.purchase.index', compact('purchases'));
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }
}