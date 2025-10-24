<?php

namespace App\Livewire\Role;

use Livewire\Component;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $slug;
    public $name;
    public $role;
    public $description;
    public $selectedPermissions = [];

    public function mount(string $slug)
    {
        $this->role = Role::where('slug', $slug)->firstOrFail();
        $this->name = $this->role->name;
        $this->description = $this->role->description;
        $this->selectedPermissions = $this->role->permissions->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->role->id,
            'description' => 'nullable|string',
        ]);

        // Update role data
        $this->role->update([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => Str::slug('rol'.'-'.$this->name.'-'.now()), // update slug dynamically
        ]);

        // Sync permissions
        $this->role->permissions()->sync($this->selectedPermissions);

        session()->flash('success', 'Role updated successfully!');
    }

    public function render()
    {
        $modules = Module::with('permissions')->latest()->get();
        return view('livewire.role.edit', compact('modules'));
    }
}
