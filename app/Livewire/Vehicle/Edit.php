<?php

namespace App\Livewire\Vehicle;

use Livewire\Component;
use App\Models\Vehicle;

class Edit extends Component
{
    public $vehicle;

    public $registration_number = '';
    public $make = '';
    public $model = '';
    public $fuel_type = '';

    protected $rules = [
        'registration_number' => 'required|string|max:50|unique:vehicles,registration_number,{{ $vehicle->id }}',
        'make'                => 'nullable|string|max:100',
        'model'               => 'nullable|string|max:100',
        'fuel_type'           => 'nullable|string|max:50',
    ];

    public function mount(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;

        $this->registration_number = $vehicle->registration_number;
        $this->make                = $vehicle->make;
        $this->model               = $vehicle->model;
        $this->fuel_type           = $vehicle->fuel_type;
    }

    public function update()
    {
        $this->validate();

        $this->vehicle->update([
            'registration_number' => $this->registration_number,
            'make'                => $this->make,
            'model'               => $this->model,
            'fuel_type'           => $this->fuel_type,
        ]);

        session()->flash('success', 'Vehicle updated successfully.');

        return redirect()->route('vehicle.index');
    }

    public function render()
    {
        return view('livewire.vehicle.edit');
    }
}