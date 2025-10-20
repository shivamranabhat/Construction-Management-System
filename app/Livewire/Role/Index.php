<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($slug)
    {
        $role = Role::whereSlug($slug)->delete();
        session()->flash('success', 'Role deleted successfully!');
    }

    public function render()
    {
        $roles = Role::query()
            ->when($this->search, fn($q) => 
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
            )
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.role.index', compact('roles'));
    }
}
