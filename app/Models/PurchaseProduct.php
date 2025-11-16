<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $fillable = [
        'purchase_id',
        'item_id',
        'tax_id',
        'quantity',
        'unit_price',
        'total_price',
        'billed_amount',
        'slug',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
    
    public function getRemainingAmountAttribute()
    {
        $total = $this->quantity * $this->unit_price;
        return max(0, $total - $this->billed_amount);
    }
    
}
