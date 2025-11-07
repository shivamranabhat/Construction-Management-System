<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use Livewire\Component;

class Show extends Component
{
    public $stock;

    public function mount($slug)
    {
        $stock = Stock::where('slug', $slug)->firstOrFail();
        $this->stock = $stock->load([
            'item',
            'project',
            'purchaseProduct.purchase.vendor',
            'purchaseProduct.purchase'
        ]);
    }

    public function render()
    {
        return view('livewire.stock.show');
    }
}