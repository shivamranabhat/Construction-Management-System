<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Worker extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'role',
        'project_id',
        'company_id',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function ($worker) {
            $worker->slug = $worker->generateUniqueSlug();
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function generateUniqueSlug(): string
    {
        $slug = Str::slug($this->name);
        $count = static::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
