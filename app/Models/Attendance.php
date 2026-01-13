<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;
use Illuminate\Support\Str;

class Attendance extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);
        static::creating(function ($attendance) {
            $attendance->slug = $attendance->generateUniqueSlug();
        });
    }

    protected $fillable = [
        'date',
        'project_id',
        'company_id',
        'worker_id',
        'in_time',
        'out_time',
        'slug',
    ];

    public function generateUniqueSlug(): string
    {
        // Load worker name or slug (fallback to id if no slug exists)
        $worker = $this->worker()->select('id', 'name', 'slug')->first();

        $workerPart = $worker?->slug
            ?? Str::slug($worker?->name ?? 'worker-' . $this->worker_id, '-', 'en')
            ?? 'worker-' . $this->worker_id;

        $datePart = \Carbon\Carbon::parse($this->date)->format('Y-m-d');

        $base = "attendance-{$datePart}-{$workerPart}";

        // Make it URL-safe and clean
        $slug = Str::slug($base, '-', 'en');

        // Check for uniqueness and append counter only if needed
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}