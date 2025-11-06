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

    public $perPage = 10;


    public function render()
    {

        $purchases = Purchase::with(['vendor', 'project', 'enteredBy'])
            ->when($this->search, fn($q) => $q->where('purchase_number', 'like', "%{$this->search}%")
                ->orWhereHas('vendor', fn($q) => $q->where('name', 'like', "%{$this->search}%")))
            ->when($this->status_filter, fn($q) => $q->where('status', $this->status_filter))
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.purchase.index', compact('purchases'));
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }
}