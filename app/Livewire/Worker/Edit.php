<?php

namespace App\Livewire\Worker;

use Livewire\Component;
use App\Models\Worker;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $worker;
    public $slug;

    public $name = '';
    public $phone = '';
    public $role = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'role' => 'nullable|string|max:100',
    ];

    public function mount($slug)
    {
        $worker = Worker::whereSlug($slug)->firstOrFail();
        $this->worker = $worker;

        $this->name = $worker->name;
        $this->phone = $worker->phone;
        $this->role = $worker->role;
    }

    public function update()
    {
        $this->validate();

        $this->worker->update([
            'name'       => $this->name,
            'phone'      => $this->phone,
            'role'       => $this->role,
            'company_id' => Auth::user()->company_id,
        ]);

        session()->flash('success', 'Worker updated successfully.');

        return redirect()->route('worker.index');
    }

    public function render()
    {
        return view('livewire.worker.edit');
    }
}