<?php
namespace App\Livewire\Bill;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $bills = Bill::with(['vendor', 'project', 'enteredBy'])
            ->when($this->search, function ($query) {
                $query->where('bill_number', 'like', '%'.$this->search.'%')
                      ->orWhereHas('vendor', fn($q) => $q->where('name', 'like', '%'.$this->search.'%'));
            })
            ->latest()
            ->paginate(10);

        return view('livewire.bill.index', compact('bills')); // Assume your main layout
    }
}