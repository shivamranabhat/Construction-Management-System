<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boq extends Model
{
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
}
