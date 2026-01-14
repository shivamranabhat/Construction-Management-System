<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;

class MaintenanceRecord extends Model
{
    
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);
    }
    protected $fillable = [
        'vehicle_id',
        'project_id',
        'company_id',
        'date',
        'description',
        'type',
        'cost',
        'service_provider',
        'notes',
        'slug',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
