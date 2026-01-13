<?php

namespace App\Livewire\Vehicle;

use Livewire\Component;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $registration_number = '';
    public $make = '';
    public $model = '';
    public $fuel_type = '';

    protected $rules = [
        'registration_number' => 'required|string|max:50|unique:vehicles,registration_number',
        'make'                => 'nullable|string|max:100',
        'model'               => 'nullable|string|max:100',
        'fuel_type'           => 'nullable|string|max:50',
    ];

    public function submit()
    {
        $this->validate();

        Vehicle::create([
            'registration_number' => $this->registration_number,
            'make'                => $this->make,
            'model'               => $this->model,
            'fuel_type'           => $this->fuel_type,
            'company_id'          => Auth::user()->company_id,
        ]);

        session()->flash('success', 'Vehicle added successfully.');

        return redirect()->route('vehicle.index');
    }

    public function render()
    {
        return view('livewire.vehicle.create');
    }
}