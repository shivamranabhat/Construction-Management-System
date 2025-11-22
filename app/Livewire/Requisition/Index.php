<?php

namespace App\Livewire\Requisition;

use App\Models\Requisition;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $perPage = 15;

    protected $queryString = ['search', 'status'];

    public function render()
    {
        $requisitions = Requisition::with(['project', 'requester', 'items.item'])
            ->when($this->search, fn($q) => $q->where('requisition_number', 'like', "%{$this->search}%")
                ->orWhere('purpose', 'like', "%{$this->search}%"))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->latest()
            ->paginate($this->perPage);

        $statusCounts = Requisition::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('livewire.requisition.index', [
            'requisitions' => $requisitions,
            'statusCounts' => $statusCounts,
        ]);
    }

    public function delete($id)
    {
        $requisition = Requisition::find($id);
        $requisition->delete();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}