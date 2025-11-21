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
            'name' => 'required|string',
            'description' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Please enter role name.',
        ]);

        // Create the role
        $role = Role::create([
            'name' => $this->name,
            'description' => $this->description,
            'company_id' => auth()->user()->company_id,
            'slug' => Str::slug($this->name),
        ]);

        // Attach selected permissions (many-to-many)
        if (!empty($this->selectedPermissions)) {
            $role->permissions()->attach($this->selectedPermissions);
        }

        return redirect()->route('role.index')->with('success', 'Role created successfully!');
        $this->dispatch('reset-select-all');
    }

    public function render()
    {
        $modules = Module::with('permissions')->latest()->get();
        return view('livewire.role.create', compact('modules'));
    }
}
