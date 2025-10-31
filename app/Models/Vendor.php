<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Vendor extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'PAN',
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

}
