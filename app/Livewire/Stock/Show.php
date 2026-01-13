<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use App\Models\Log;
use Livewire\Component;

class Show extends Component
{
    public Stock $stock;
    public $usageLogs;

    public function mount($slug)
    {
       $details = Stock::whereSlug($slug)->firstOrFail();
       $itemId = $details->item_id;
       $projectId = $details->project_id;

        // Use global scopes + explicit filters
        $this->stock = Stock::query()
            ->where('item_id', $itemId)
            ->when($projectId !== null, fn($q) => $q->where('project_id', $projectId))
            ->when($projectId === null, fn($q) => $q->whereNull('project_id'))
            ->selectRaw('item_id, project_id, SUM(stock) as total_stock, MAX(updated_at) as last_updated')
            ->with(['item', 'project'])
            ->groupBy('item_id', 'project_id')
            ->firstOrFail();
        // Fetch usage logs for this item and project
        $this->usageLogs = Log::query()
                            ->whereJsonContains('items_used', [
                                'item_id' => (string) $this->stock->item_id
                            ])
                            ->where('status', 'approved')
                            ->when(
                                $this->stock->project_id !== null,
                                fn ($q) => $q->where('project_id', $this->stock->project_id),
                                fn ($q) => $q->whereNull('project_id')
                            )
                            ->orderByDesc('date')
                            ->orderByDesc('created_at')
                            ->get();
    }

    public function render()
    {
        return view('livewire.stock.show');
    }
}