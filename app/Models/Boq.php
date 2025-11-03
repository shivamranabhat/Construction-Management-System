<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;

class Boq extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);
    }

    protected $fillable = [
        'project_id',
        'name',
        'serial_number',
        'item_description',
        'unit',
        'quantity',
        'unit_rate',
        'amount',
        'parent_id',
        'company_id',
        'summary',
        'tax_id',
        'slug',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function parent()
    {
        return $this->belongsTo(Boq::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Boq::class, 'parent_id');
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

}
