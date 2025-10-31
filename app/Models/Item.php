<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Item extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    
    protected $fillable = [
        'name',
        'category_id',
        'type',
        'description',
        'unit',
        'reorder_level',
        'company_id',
        'slug',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
