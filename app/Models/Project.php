<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Project extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable = [
        'name',
        'code',
        'client',
        'start_date',
        'end_date',
        'budget',
        'status',
        'company_id',
        'slug',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function boqs()
    {
        return $this->hasMany(Boq::class);
    }
}
