<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;
use Illuminate\Support\Str;

class Vehicle extends Model
{

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::creating(function ($vehicle) {
            $vehicle->slug = $vehicle->generateUniqueSlug();
        });
    }

    protected $fillable = [
        'registration_number',
        'make',
        'model',
        'fuel_type',
        'company_id',
        'slug',
    ];

    public function generateUniqueSlug(): string
    {
        $slug = Str::slug($this->make.'-'.$this->model.'-'.$this->registration_number);
        $count = static::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function maintenanceRecords()
    {
        return $this->hasMany(MaintenanceRecord::class);
    }
}
