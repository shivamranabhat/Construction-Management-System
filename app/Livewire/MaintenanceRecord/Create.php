<?php

namespace App\Livewire\MaintenanceRecord;

use Livewire\Component;
use App\Models\MaintenanceRecord;
use App\Models\Vehicle;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Create extends Component
{
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

    public function mount()
    {
        $this->date = today()->format('Y-m-d');

        // Vehicles (company-wide)
        $this->vehicles = Vehicle::orderBy('registration_number')->pluck('registration_number', 'id');

        // Projects (scoped)
        $query = Project::query();
        if (Auth::user()->type === 'Company') {
            $query->where('company_id', Auth::user()->company_id);
        } else {
            $query->whereHas('users', fn($q) => $q->where('user_id', Auth::id()));
        }
        $this->userProjects = $query->orderBy('name')->pluck('name', 'id');
    }

    public function submit()
    {
        $this->validate();

        MaintenanceRecord::create([
            'vehicle_id'          => $this->vehicle_id,
            'project_id'          => $this->project_id,
            'company_id'          => Auth::user()->company_id,
            'date'                => $this->date,
            'description'         => $this->description,
            'type'                => $this->type,
            'cost'                => $this->cost,
            'service_provider'    => $this->service_provider,
            'notes'               => $this->notes,
            'slug'                => Str::slug(now() . '-' . Str::random(6)),
        ]);

        session()->flash('success', 'Maintenance record created successfully.');

        return redirect()->route('maintenance-record.index');
    }

    public function render()
    {
        return view('livewire.maintenance-record.create');
    }
}