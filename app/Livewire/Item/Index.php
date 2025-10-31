<?php

namespace App\Livewire\Item;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
use App\Models\Category;

class Index extends Component
{
   use WithPagination;

    public $search = '';
    public $perPage = 10; 

    protected $paginationTheme = 'bootstrap'; 

    public function updatingSearch()
    {
        $this->resetPage(); // reset to first page when searching
    }

    public function updatingPerPage()
    {
        $this->resetPage(); // reset to first page when changing perPage
    }
    public function delete($slug)
    {
        $item = Item::whereSlug($slug)->delete();
        session()->flash('success', 'Item deleted successfully!');
    }

    public function render()
    {
       $items = Item::query()
                ->with('category')
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%')
                        ->orWhereHas('category', function ($catQuery) {
                            $catQuery->where('name', 'like', '%' . $this->search . '%');
                        });
                    });
                })
                ->latest()
                ->paginate($this->perPage);

        return view('livewire.item.index', compact('items'));
    }
}
