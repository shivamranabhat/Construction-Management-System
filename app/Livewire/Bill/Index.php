<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status_filter = '';
    public $date_range = '';
    public $date_from = '';
    public $date_to = '';
    public $showFilters = false;

    protected $queryString = ['search', 'status_filter', 'date_range'];

    public function mount()
    {
        $this->date_from = now()->subDays(30)->format('Y-m-d');
        $this->date_to = now()->format('Y-m-d');
    }

    public function delete($slug)
    {
        $bill = Bill::whereSlug($slug)->first();
        $purchase = Purchase::find($bill->purchase_id);
        $purchase->update(['status' => 'draft']);
        $bill->delete();
        
        session()->flash('success', 'Bill deleted successfully.');
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function updated($property)
    {
        if (in_array($property, ['search', 'status_filter', 'date_range', 'date_from', 'date_to'])) {
            $this->resetPage();
        }
    }

    public function getActiveFiltersProperty()
    {
        return collect([
            $this->search,
            $this->status_filter,
            $this->date_range && $this->date_range !== 'custom' ? $this->date_range : null,
            $this->date_range === 'custom' && $this->date_from && $this->date_to ? 1 : null,
        ])->filter()->count();
    }

    public function render()
    {
        $query = Bill::with(['vendor', 'project'])
            ->when($this->search, fn($q) =>
                $q->where('bill_number', 'like', "%{$this->search}%")
                  ->orWhereHas('vendor', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"))
            )
            ->when($this->status_filter, fn($q) => $q->where('status', $this->status_filter))
            ->when($this->date_range, function ($q) {
                return match ($this->date_range) {
                    '7'     => $q->where('bill_date', '>=', now()->subDays(7)),
                    '30'    => $q->where('bill_date', '>=', now()->subDays(30)),
                    '90'    => $q->where('bill_date', '>=', now()->subDays(90)),
                    'custom'=> $q->whereBetween('bill_date', [$this->date_from, $this->date_to]),
                    default => $q
                };
            })
            ->latest();

        $bills = $query->paginate(15);

        return view('livewire.bill.index', [
            'bills'         => $bills,
            'totalBills'    => Bill::count(),
            'unpaidCount'   => Bill::whereIn('status', ['draft', 'sent', 'overdue'])->count(),
            'overdueCount'  => Bill::where('status', 'overdue')->count(),
            'totalAmount'   => Bill::sum('total'),
            'activeFilters' => $this->activeFilters,
        ]);
    }
}
