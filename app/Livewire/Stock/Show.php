<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Show extends Component
{
    public $stock;
    public $itemId;
    public $projectId;

    public function mount($slug)
    {
        // Parse slug: stock-{item_id}-{project_id|global}
        preg_match('/^stock-(\d+)-(global|\d+)$/', $slug, $matches);
        if (!$matches) abort(404);

        $this->itemId = $matches[1];
        $this->projectId = $matches[2] === 'global' ? null : $matches[2];

        $this->loadStock();
    }

    public function loadStock()
    {
        $query = Stock::select([
                'item_id',
                'project_id',
                DB::raw('SUM(stock) as total_stock'),
                DB::raw('MAX(updated_at) as last_updated'),
            ])
            ->with(['item', 'project'])
            ->where('item_id', $this->itemId)
            ->where(function ($q) {
                $this->projectId
                    ? $q->where('project_id', $this->projectId)
                    : $q->whereNull('project_id');
            })
            ->groupBy('item_id', 'project_id');

        $this->stock = $query->firstOrFail();
        $this->stock->slug = $this->generateSlug();
    }

    protected function generateSlug()
    {
        return 'stock-' . $this->itemId . '-' . ($this->projectId ?? 'global');
    }

    public function render()
    {
        return view('livewire.stock.show');
    }
}