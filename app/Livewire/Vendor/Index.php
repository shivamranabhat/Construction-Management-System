<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vendor;

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
        $vendor = Vendor::whereSlug($slug)->delete();
        session()->flash('success', 'Vendor deleted successfully!');
    }

    public function render()
    {
        $vendors = Vendor::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->select('id', 'name','created_at', 'slug')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.vendor.index', [
            'vendors' => $vendors
        ]);
    }

}
