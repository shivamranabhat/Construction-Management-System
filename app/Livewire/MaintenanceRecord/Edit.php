<?php

namespace App\Livewire\MaintenanceRecord;

use Livewire\Component;
use App\Models\MaintenanceRecord;
use App\Models\Vehicle;
use App\Models\Project;
use Carbon\Carbon;

class Edit extends Component
{
    public $maintenanceRecord;

    public $vehicle_id = '';
    public $project_id = '';
    public $date = '';
    public $description = '';
    public $type = '';
    public $cost = '';
    public $service_provider = '';
    public $notes = '';

    public $vehicles = [];
    public $userProjects = [];

    protected $rules = [
        'vehicle_id'          => 'required|exists:vehicles,id',
        'project_id'          => 'required|exists:projects,id',
        'date'                => 'required|date',
        'description'         => 'required|string',
        'type'                => 'nullable|string|max:100',
        'cost'                => 'required|numeric|min:0',
        'service_provider'    => 'nullable|string|max:150',
        'notes'               => 'nullable|string',
    ];

    public function mount($slug)
    {;
        $this->maintenanceRecord = MaintenanceRecord::where('slug', $slug)->firstOrFail();

        $this->vehicle_id        = $this->maintenanceRecord->vehicle_id;
        $this->project_id        = $this->maintenanceRecord->project_id;
        $this->date              = Carbon::parse($this->maintenanceRecord->date)->format('Y-m-d');
        $this->description       = $this->maintenanceRecord->description;
        $this->type              = $this->maintenanceRecord->type;
        $this->cost              = $this->maintenanceRecord->cost;
        $this->service_provider  = $this->maintenanceRecord->service_provider;
        $this->notes             = $this->maintenanceRecord->notes;

        $this->vehicles = Vehicle::orderBy('registration_number')->pluck('registration_number', 'id');

        $query = Project::query();
        if (auth()->user()->type === 'Company') {
            $query->where('company_id', auth()->user()->company_id);
        } else {
            $query->whereHas('users', fn($q) => $q->where('user_id', auth()->id()));
        }
        $this->userProjects = $query->orderBy('name')->pluck('name', 'id');
    }

    public function update()
    {
        $this->validate();

        $this->maintenanceRecord->update([
            'vehicle_id'          => $this->vehicle_id,
            'project_id'          => $this->project_id,
            'date'                => $this->date,
            'description'         => $this->description,
            'type'                => $this->type,
            'cost'                => $this->cost,
            'service_provider'    => $this->service_provider,
            'notes'               => $this->notes,
        ]);

        session()->flash('success', 'Maintenance record updated successfully.');

        return redirect()->route('maintenance-record.index');
    }

    public function render()
    {
        return view('livewire.maintenance-record.edit');
    }
}