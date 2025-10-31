<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
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

}
