<?php

namespace App\Livewire\Worker;

use Livewire\Component;
use App\Models\Worker;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $name = '';
    public $phone = '';
    public $role = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'role' => 'nullable|string|max:100',
    ];


    public function submit()
    {
        $this->validate();

        Worker::create([
            'name'       => $this->name,
            'phone'      => $this->phone,
            'role'       => $this->role,
            'company_id' => Auth::user()->company_id,
        ]);

        session()->flash('success', 'Worker created successfully.');

        return redirect()->route('worker.index');
    }

    public function render()
    {
        return view('livewire.worker.create');
    }
}