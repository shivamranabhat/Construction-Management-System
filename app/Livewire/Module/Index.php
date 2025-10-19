<?php

namespace App\Livewire\Module;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;
use App\Models\Permission;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10; // default items per page

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
        $module = Module::whereSlug($slug)->delete();
        Permission::where('module_id', $module->id)->delete();
        session()->flash('success', 'Module deleted successfully!');
    }

    public function render()
    {
        $modules = Module::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->select('id', 'name','created_at', 'slug')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.module.index', [
            'modules' => $modules
        ]);
    }

}
