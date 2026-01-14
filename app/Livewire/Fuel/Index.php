<?php

namespace App\Livewire\Fuel;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FuelLog;
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

    public function delete($fuelLogId)
    {
        $fuelLog = FuelLog::findOrFail($fuelLogId);

        // Optional: $this->authorize('delete-fuel-log');

        $fuelLog->delete();

        session()->flash('success', "Fuel log deleted successfully.");
    }

    public function render()
    {
        $fuelLogs = FuelLog::query()
            ->with(['vehicle', 'project'])
            ->when($this->search, function ($q) {
                $q->where('notes', 'like', "%{$this->search}%")
                  ->orWhereHas('vehicle', fn($vq) => $vq->where('registration_number', 'like', "%{$this->search}%"))
                  ->orWhereHas('project', fn($pq) => $pq->where('name', 'like', "%{$this->search}%"));
            })
            ->latest('date')
            ->paginate($this->perPage);

        return view('livewire.fuel.index', compact('fuelLogs'));
    }
}