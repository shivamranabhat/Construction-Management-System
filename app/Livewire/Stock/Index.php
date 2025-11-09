<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use App\Models\Project;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $project_filter = '';
    public $perPage = 15;

    protected $queryString = ['search', 'project_filter'];

    public function mount()
    {
        $this->projects = Project::orderBy('name')->get();
    }

    public function render()
    {
        $stocks = Stock::select([
                'item_id',
                'project_id',
                'company_id',
                DB::raw('SUM(stock) as total_stock'),
                DB::raw('MAX(updated_at) as last_updated'),
            ])
            ->with(['item', 'project'])
            ->when($this->search, function ($q) {
                $q->whereHas('item', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"));
            })
            ->when($this->project_filter !== '', function ($q) {
                if ($this->project_filter === '0') {
                    $q->whereNull('project_id');
                } else {
                    $q->where('project_id', $this->project_filter);
                }
            })
            ->groupBy('item_id', 'project_id', 'company_id')
            ->havingRaw('SUM(stock) > 0 OR SUM(stock) < 0') // optional: hide zero
            ->orderByDesc('last_updated')
            ->paginate($this->perPage);

        // Add slug for routing
        $stocks->getCollection()->transform(function ($stock) {
            $stock->slug = $this->generateSlug($stock);
            return $stock;
        });

        return view('livewire.stock.index', [
            'stocks' => $stocks,
            'projects' => $this->projects,
        ]);
    }

    protected function generateSlug($stock)
    {
        return 'stock-' . $stock->item_id . '-' . ($stock->project_id ?? 'global');
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingProjectFilter() { $this->resetPage(); }
}