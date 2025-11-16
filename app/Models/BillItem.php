<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $fillable = ['bill_id', 'item_id', 'quantity', 'unit_price', 'tax_id','purchase_product_id', 'total'];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function purchaseProduct()
    {
        return $this->belongsTo(PurchaseProduct::class, 'purchase_product_id');
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}