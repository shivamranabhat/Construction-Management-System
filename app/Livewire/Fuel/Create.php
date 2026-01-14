<?php

namespace App\Livewire\Fuel;

use Livewire\Component;
use App\Models\FuelLog;
use App\Models\Vehicle;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Create extends Component
{
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

    public function mount()
    {
        $this->date = today()->format('Y-m-d');

        // Vehicles (all of company - no project filter here)
        $this->vehicles = Vehicle::orderBy('registration_number')->pluck('registration_number', 'id');

        // Projects (scoped as usual)
        $query = Project::query();
        if (Auth::user()->type === 'Company') {
            $query->where('company_id', Auth::user()->company_id);
        } else {
            $query->whereHas('users', fn($q) => $q->where('user_id', Auth::id()));
        }
        $this->userProjects = $query->orderBy('name')->pluck('name', 'id');
    }

    public function updatedLitersOrPrice()
    {
        if ($this->liters && $this->price_per_liter) {
            $this->total_cost = number_format($this->liters * $this->price_per_liter, 2, '.', '');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        FuelLog::create([
            'vehicle_id'          => $this->vehicle_id,
            'project_id'          => $this->project_id,
            'company_id'          => Auth::user()->company_id,
            'date'                => $this->date,
            'liters'              => $this->liters,
            'price_per_liter'     => $this->price_per_liter,
            'total_cost'          => $this->total_cost,
            'notes'               => $this->notes,
            'slug'                => Str::slug(now() . '-' . Str::random(6)),
        ]);

        session()->flash('success', 'Fuel log recorded successfully.');

        return redirect()->route('fuel-log.index');
    }

    public function render()
    {
        return view('livewire.fuel.create');
    }
}