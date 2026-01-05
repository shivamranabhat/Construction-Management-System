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

    public $allowedModules = [
        'account','attendance', 'bill', 'boq', 'category', 'item','log', 'module',
        'payment', 'project', 'purchase', 'requisition',
        'role', 'tax', 'vendor', 'worker',
    ];
    public function mount(string $slug)
    {
        $this->module = Module::where('slug', $slug)->firstOrFail();

        // Ensure current name is in allowed list (safety)
        if (!in_array($this->module->name, $this->allowedModules)) {
            abort(404, 'Module not found or invalid.');
        }

        $this->name = $this->module->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|in:' . implode(',', $this->allowedModules),
        ], [
            'name.required' => 'Please select a module.',
            'name.in'       => 'Invalid module selected.',
        ]);

        // Generate new slug
        $newSlug = Str::slug('mod-' . $this->name . '-' . now()->timestamp);

        // Update module
        $this->module->update([
            'name' => $this->name,
            'slug' => $newSlug,
        ]);

        // Update all related permission slugs
        // Example: old: view-project → new: view-account
        foreach ($this->module->permissions as $permission) {
            // Extract action (view, create, edit, delete)
            $action = strtok($permission->slug, '-'); // gets part before first '-'

            $newPermissionSlug = Str::slug("{$action}-{$this->name}");

            $permission->update([
                'slug' => $newPermissionSlug,
                // Optional: update display name too
                'name' => ucfirst($action) . ' ' . ucfirst($this->name),
            ]);
        }

        session()->flash('success', 'Module updated successfully.');

        return redirect()->route('module.index');
    }

    public function render()
    {
        return view('livewire.module.edit');
    }
}