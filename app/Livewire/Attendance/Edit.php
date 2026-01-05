<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Worker;
use App\Models\Project;

class Edit extends Component
{
    public $attendance;

    public $project_id;
    public $worker_id;
    public $date;
    public $in_time;
    public $out_time;

    public $userProjects = [];
    public $workers = [];

    protected $rules = [
        'project_id' => 'required|exists:projects,id',
        'worker_id' => 'required|exists:workers,id',
        'date' => 'required|date',
        'in_time' => 'nullable|date_format:H:i',
        'out_time' => 'nullable|date_format:H:i|after:in_time',
    ];

    public function mount(Attendance $attendance)
    {
        $this->attendance = $attendance;

        $this->project_id = $attendance->project_id;
        $this->worker_id = $attendance->worker_id;
        $this->date = $attendance->date->format('Y-m-d');
        $this->in_time = $attendance->in_time?->format('H:i');
        $this->out_time = $attendance->out_time?->format('H:i');

        // Load projects
        $query = Project::query();
        if (auth()->user()->type === 'Company') {
            $query->where('company_id', auth()->user()->company_id);
        } else {
            $query->whereHas('users', fn($q) => $q->where('user_id', auth()->id()));
        }
        $this->userProjects = $query->pluck('name', 'id');

        // Load workers for current project
        $this->workers = Worker::where('project_id', $this->project_id)
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function updatedProjectId()
    {
        $this->workers = Worker::where('project_id', $this->project_id)
            ->orderBy('name')
            ->pluck('name', 'id');
        $this->worker_id = '';
    }

    public function update()
    {
        $this->validate();

        $this->attendance->update([
            'project_id' => $this->project_id,
            'worker_id' => $this->worker_id,
            'date' => $this->date,
            'in_time' => $this->in_time ?: null,
            'out_time' => $this->out_time ?: null,
        ]);

        session()->flash('success', 'Attendance updated successfully.');

        return redirect()->route('attendance.index');
    }

    public function render()
    {
        return view('livewire.attendance.edit');
    }
}