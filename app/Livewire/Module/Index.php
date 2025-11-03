<?php

namespace App\Livewire\Module;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;
use App\Models\Permission;
use App\Traits\PermissionAwareDelete;

class Index extends Component
{
    use WithPagination;

    use PermissionAwareDelete;
    
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
        $this->deleteWithPermission(Module::class, $slug, 'delete_module');
    }

    public function render()
    {
        $modules = Module::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->select('id', 'name','created_at', 'slug')
            ->orderBy('name')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.module.index', compact('modules'));
    }

}
