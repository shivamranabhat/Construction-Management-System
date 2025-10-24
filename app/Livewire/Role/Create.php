<?php

namespace App\Livewire\Role;

use Livewire\Component;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    public $description;
    public $selectedPermissions = []; // store selected permission IDs

    
    public function save()
    {
        // Validate inputs
        $this->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Please enter role name.',
            'name.unique' => 'This role name already exists.',
        ]);

        $slug = Str::slug('rol'.'-'.$this->name.'-'.now());;
        // Create the role
        $role = Role::create([
            'name' => $this->name,
            'description' => $this->description,
            'company_id' => auth()->user()->company_id,
            'slug' => $slug,
        ]);

        // Attach selected permissions (many-to-many)
        if (!empty($this->selectedPermissions)) {
            $role->permissions()->attach($this->selectedPermissions);
        }

        // Flash success message
        session()->flash('success', 'Role created successfully!');

        // Reset fields
        $this->reset(['name', 'description', 'selectedPermissions']);
        $this->dispatch('reset-select-all');
    }

    public function render()
    {
        $modules = Module::with('permissions')->latest()->get();
        return view('livewire.role.create', compact('modules'));
    }
}
