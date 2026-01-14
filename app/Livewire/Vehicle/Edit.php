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

    public function mount($slug)
    {
        $this->vehicle = Vehicle::whereSlug($slug)->firstOrFail();

        $this->registration_number = $this->vehicle->registration_number;
        $this->make                = $this->vehicle->make;
        $this->model               = $this->vehicle->model;
        $this->fuel_type           = $this->vehicle->fuel_type;
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