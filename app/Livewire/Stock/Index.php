<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $project_filter = '';
    public $perPage = 10;

    protected $queryString = ['search', 'project_filter'];

    public function render()
    {
        $stocks = Stock::with(['item', 'project', 'purchaseProduct.purchase'])
            ->when($this->search, fn($q) => $q->whereHas('item', fn($sq) => $sq->where('name', 'like', "%{$this->search}%")))
            ->when($this->project_filter, fn($q) => $q->where('project_id', $this->project_filter))
            ->latest()
            ->paginate($this->perPage);

        $projects = Project::orderBy('name')->get();

        return view('livewire.stock.index', compact('stocks', 'projects'));
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingProjectFilter() { $this->resetPage(); }
}