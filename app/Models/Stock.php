<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;

class Stock extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);
    }

    protected $fillable = [
        'item_id',
        'stock',
        'project_id',
        'company_id',
        'purchase_product_id',
        'slug',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function purchaseProduct()
    {
        return $this->belongsTo(PurchaseProduct::class);
    }
}

