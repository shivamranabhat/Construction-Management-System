<?php

namespace App\Livewire\Vehicle;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);

        // Optional: $this->authorize('delete-vehicle');

        $vehicle->delete();

        session()->flash('success', "Vehicle {$vehicle->registration_number} deleted successfully.");
    }

    public function render()
    {
        $vehicles = Vehicle::query()
            ->when($this->search, function ($q) {
                $q->where('registration_number', 'like', "%{$this->search}%")
                  ->orWhere('make', 'like', "%{$this->search}%")
                  ->orWhere('model', 'like', "%{$this->search}%")
                  ->orWhere('fuel_type', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.vehicle.index', compact('vehicles'));
    }
}