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
    public $project_id = '';

    public $userProjects = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'role' => 'nullable|string|max:100',
        'project_id' => 'required|exists:projects,id',
    ];

    public function mount($slug)
    {
        $worker = Worker::whereSlug($slug)->firstOrFail();
        $this->worker = $worker;

        $this->name = $worker->name;
        $this->phone = $worker->phone;
        $this->role = $worker->role;
        $this->project_id = $worker->project_id;

        // Load accessible projects
        $query = Project::query();

        if (Auth::user()->type === 'Company') {
            $query->where('company_id', Auth::user()->company_id);
        } else {
            $query->whereHas('users', fn($q) => $q->where('user_id', Auth::id()));
        }

        $this->userProjects = $query->orderBy('name')->pluck('name', 'id');
    }

    public function update()
    {
        $this->validate();

        $this->worker->update([
            'name'       => $this->name,
            'phone'      => $this->phone,
            'role'       => $this->role,
            'project_id' => $this->project_id,
            'company_id' => Auth::user()->company_id ?? Project::find($this->project_id)->company_id,
        ]);

        session()->flash('success', 'Worker updated successfully.');

        return redirect()->route('worker.index');
    }

    public function render()
    {
        return view('livewire.worker.edit');
    }
}