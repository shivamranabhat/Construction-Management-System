<?php

namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $slug;
    public $module;
    public $name;

    public function mount(string $slug)
    {
        $this->module = Module::where('slug', $slug)->firstOrFail();
        $this->name = $this->module->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:modules,name,' . $this->module->id,
        ],
        [
            'name.required' => 'Please enter module name.', 
            'name.unique' => 'This module name is already exists.'
        ]);
        $slug = Str::slug('mod'.'-'.$this->name.'-'.now());
        $this->module->update([
            'name' => $this->name,
            'slug' => $slug,
        ]);
        foreach ($this->module->permissions as $permission) {
            $action = strtolower(explode('-', $permission->slug)[0]); 
            $permission->update([
                'slug' => \Str::slug("{$action}-{$this->name}"),
            ]);
        }
        session()->flash('success', 'Module updated successfully!');
        $this->reset('name');
    }

    public function render()
    {
        return view('livewire.module.edit');
    }
}
