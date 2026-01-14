<?php

namespace App\Livewire\MaintenanceRecord;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MaintenanceRecord;
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

    public function delete($recordId)
    {
        $record = MaintenanceRecord::findOrFail($recordId);

        $record->delete();

        session()->flash('success', 'Maintenance record deleted successfully.');
    }

    public function render()
    {
        $records = MaintenanceRecord::query()
            ->with(['vehicle', 'project'])
            ->when($this->search, function ($q) {
                $q->where('description', 'like', "%{$this->search}%")
                  ->orWhere('service_provider', 'like', "%{$this->search}%")
                  ->orWhere('notes', 'like', "%{$this->search}%")
                  ->orWhereHas('vehicle', fn($vq) => $vq->where('registration_number', 'like', "%{$this->search}%"));
            })
            ->latest('date')
            ->paginate($this->perPage);

        return view('livewire.maintenance-record.index', compact('records'));
    }
}