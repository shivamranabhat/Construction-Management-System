<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 15;

    protected $queryString = ['search'];

    // Listen to project switcher changes → just refresh the component
    protected $listeners = [
        'projectSwitched' => '$refresh',
    ];

    public function render()
    {
        $stocks = Stock::select([
                'item_id',
                'project_id',
                'company_id',
                'slug',
                DB::raw('SUM(stock) as total_stock'),
                DB::raw('MAX(updated_at) as last_updated'),
            ])
            ->with(['item', 'project'])

            ->when($this->search, function ($q) {
                $q->whereHas('item', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"));
            })

            // → No need for manual project filtering anymore!
            // ActiveProjectScope handles it automatically

            ->groupBy('item_id', 'project_id', 'company_id','slug')
            ->havingRaw('SUM(stock) > 0 OR SUM(stock) < 0') // optional
            ->orderByDesc('last_updated')
            ->paginate($this->perPage);

        return view('livewire.stock.index', [
            'stocks' => $stocks,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}