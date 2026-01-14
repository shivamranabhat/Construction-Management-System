<?php

namespace App\Livewire\Fuel;

use Livewire\Component;
use App\Models\FuelLog;
use App\Models\Vehicle;
use App\Models\Project;
use Carbon\Carbon;

class Edit extends Component
{
    public $fuelLog;

    public $vehicle_id = '';
    public $project_id = '';
    public $date = '';
    public $liters = '';
    public $price_per_liter = '';
    public $total_cost = '';
    public $notes = '';

    public $vehicles = [];
    public $userProjects = [];

    protected $rules = [
        'vehicle_id'          => 'required|exists:vehicles,id',
        'project_id'          => 'required|exists:projects,id',
        'date'                => 'required|date',
        'liters'              => 'required|numeric|min:0.01',
        'price_per_liter'     => 'required|numeric|min:0',
        'total_cost'          => 'required|numeric|min:0',
        'notes'               => 'nullable|string',
    ];

    public function mount($slug)
    {
        $this->fuelLog = FuelLog::whereSlug($slug)->firstOrFail();
        

        $this->vehicle_id        = $this->fuelLog->vehicle_id;
        $this->project_id        = $this->fuelLog->project_id;
        $this->date              = Carbon::parse($this->fuelLog->date)->format('Y-m-d');
        $this->liters            = $this->fuelLog->liters;
        $this->price_per_liter   = $this->fuelLog->price_per_liter;
        $this->total_cost        = $this->fuelLog->total_cost;
        $this->notes             = $this->fuelLog->notes;

        // Vehicles
        $this->vehicles = Vehicle::orderBy('registration_number')->pluck('registration_number', 'id');

        // Projects
        $query = Project::query();
        if (auth()->user()->type === 'Company') {
            $query->where('company_id', auth()->user()->company_id);
        } else {
            $query->whereHas('users', fn($q) => $q->where('user_id', auth()->id()));
        }
        $this->userProjects = $query->orderBy('name')->pluck('name', 'id');
    }

    public function updatedLitersOrPrice()
    {
        if ($this->liters && $this->price_per_liter) {
            $this->total_cost = number_format($this->liters * $this->price_per_liter, 2, '.', '');
        }
    }

    public function update()
    {
        $this->validate();

        $this->fuelLog->update([
            'vehicle_id'          => $this->vehicle_id,
            'project_id'          => $this->project_id,
            'date'                => $this->date,
            'liters'              => $this->liters,
            'price_per_liter'     => $this->price_per_liter,
            'total_cost'          => $this->total_cost,
            'notes'               => $this->notes,
        ]);

        session()->flash('success', 'Fuel log updated successfully.');

        return redirect()->route('fuel-log.index');
    }

    public function render()
    {
        return view('livewire.fuel.edit');
    }
}