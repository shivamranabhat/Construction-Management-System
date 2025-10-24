<?php

namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;

    public function store()
    {
        $this->validate([
            'name' => 'required|string|unique:modules,name',
        ],[
            'name.required' => 'Please enter module name.',
            'name.unique' => 'This module name is already exists.',
        ]);

        $slug = Str::slug('mod'.'-'.$this->name.'-'.now());
        $module = Module::create([
            'name' => $this->name,
            'company_id' => auth()->user()->company_id,
            'slug' => $slug,
        ]);

        $actions = ['Create','Preview','Update','Delete'];

        foreach ($actions as $action) {
            Permission::create([
                'name' => $action,
                'module_id' => $module->id,
                'slug' => Str::slug("{$action}-{$this->name}"),
            ]);
        }

        session()->flash('message', 'Module saved successfully!');
        $this->name = '';
        // $this->redirectRoute('module.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.module.create');
    }
}
