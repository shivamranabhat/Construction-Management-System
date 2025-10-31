<?php

namespace App\Livewire\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

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
        $category = Category::where('slug', $slug)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();
        $category->delete();

        session()->flash('success', 'Category deleted successfully!');
    }

    public function render()
    {
        $categories = Category::where('company_id', auth()->user()->company_id)
            ->where('name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.category.index', compact('categories'));
    }
}

