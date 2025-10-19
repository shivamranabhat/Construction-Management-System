<?php

namespace App\Livewire\Role;

use Livewire\Component;
use App\Models\Module;
use App\Models\Role;
use App\Models\Permission;

class Create extends Component
{
    public function render()
    {
        $modules = Module::with('permissions')->latest()->get();
        return view('livewire.role.create',compact('modules'));
    }
}
