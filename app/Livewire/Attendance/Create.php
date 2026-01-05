<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Worker;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $project_id = '';
    public $worker_id = '';
    public $date = '';
    public $in_time = '';
    public $out_time = '';

    public $userProjects = [];
    public $workers = [];

    protected $rules = [
        'project_id' => 'required|exists:projects,id',
        'worker_id' => 'required|exists:workers,id',
        'date' => 'required|date',
        'in_time' => 'nullable|date_format:H:i',
        'out_time' => 'nullable|date_format:H:i|after:in_time',
    ];

    public function mount()
    {
        $this->date = today()->format('Y-m-d');

        $query = Project::query();
        if (Auth::user()->type === 'Company') {
            $query->where('company_id', Auth::user()->company_id);
        } else {
            $query->whereHas('users', fn($q) => $q->where('user_id', Auth::id()));
        }
        $this->userProjects = $query->orderBy('name')->pluck('name', 'id');
    }

    public function updatedProjectId()
    {
        $this->workers = Worker::where('project_id', $this->project_id)
            ->orderBy('name')
            ->pluck('name', 'id');
        $this->worker_id = '';
    }

    public function submit()
    {
        $this->validate();

        // Prevent duplicate entry
        $exists = Attendance::where('worker_id', $this->worker_id)
            ->where('date', $this->date)
            ->exists();

        if ($exists) {
            $this->addError('worker_id', 'Attendance already marked for this worker on this date.');
            return;
        }

        Attendance::create([
            'project_id' => $this->project_id,
            'worker_id' => $this->worker_id,
            'date' => $this->date,
            'in_time' => $this->in_time ?: null,
            'out_time' => $this->out_time ?: null,
            'company_id' => Auth::user()->company_id,
        ]);

        session()->flash('success', 'Attendance marked successfully.');

        return redirect()->route('attendance.index');
    }

    public function render()
    {
        return view('livewire.attendance.create');
    }
}