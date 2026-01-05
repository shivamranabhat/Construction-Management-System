<?php

namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name = '';

    // List of allowed modules (must match exactly what you allow)
    public $allowedModules = [
        'account','attendance', 'bill', 'boq', 'category', 'item','log', 'module',
        'payment', 'project', 'purchase', 'requisition',
        'role', 'tax', 'vendor', 'worker',
    ];

    public function store()
    {
        $this->validate([
            'name' => 'required|in:' . implode(',', $this->allowedModules),
        ], [
            'name.required' => 'Please select a module.',
            'name.in'       => 'Invalid module selected. Please choose from the list.',
        ]);

        // Prevent duplicate module per company
        $exists = Module::where('name', $this->name)
            ->where('company_id', auth()->user()->company_id)
            ->exists();

        if ($exists) {
            $this->addError('name', 'This module has already been added.');
            return;
        }

        $slug = Str::slug('mod-' . $this->name . '-' . now()->timestamp);

        $module = Module::create([
            'name'       => $this->name,
            'company_id' => auth()->user()->company_id,
            'slug'       => $slug,
        ]);

        // Auto-create standard permissions
        $actions = ['Create', 'Preview', 'Update', 'Delete', 'Approve', 'Decline'];

        foreach ($actions as $action) {
            \App\Models\Permission::create([
                'name'       => $action . ' ' . ucfirst($this->name),
                'module_id'  => $module->id,
                'company_id' => auth()->user()->company_id,
                'slug'       => Str::slug("{$action}-{$this->name}"),
            ]);
        }

        session()->flash('success', "Module '{$this->name}' created with 6 permissions.");

        return redirect()->route('module.index');
    }

    public function render()
    {
        return view('livewire.module.create');
    }
}