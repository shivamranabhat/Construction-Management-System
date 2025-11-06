<?php

namespace App\Livewire\Tax;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tax;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($slug)
    {
        $tax = Tax::where('slug', $slug)
            ->firstOrFail();
        $tax->delete();

        session()->flash('success', 'Tax deleted successfully!');
    }

    public function render()
    {
        $taxes = Tax::where('name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.tax.index', compact('taxes'));
    }
}

