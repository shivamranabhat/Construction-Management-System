<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Tax extends Model
{

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    protected $fillable = [
        'name',
        'rate',
        'company_id',
        'slug',
    ];

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function boqs()
    {
        return $this->hasMany(Boq::class);
    }

}
