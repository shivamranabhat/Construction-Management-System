<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;

class Log extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);

        // Auto-generate slug when creating
        static::creating(function ($log) {
            $log->slug = $log->generateUniqueSlug();
        });
    }
    protected $fillable=[
        'project_id',
        'company_id',
        'date',
        'tasks',
        'manpower_count',
        'hours',
        'photos',
        'items_used',
        'status',
        'slug',
    ];
    protected $casts = [
        'tasks' => 'array',
        'photos' => 'array',
        'items_used' => 'array',
    ];
    /**
     * Generate a unique slug based on date and project
     */
    public function generateUniqueSlug(): string
    {
        $base = 'log-' . $this->date; // e.g., log-2026-01-04
        $slug = Str::slug($base);

        // Ensure uniqueness within the same project
        $existing = static::where('project_id', $this->project_id)
            ->where('slug', 'LIKE', $slug . '%')
            ->count();

        if ($existing > 0) {
            $slug = $slug . '-' . ($existing + 1);
        }

        return $slug;
    }

    /**
     * Optional: Route key for model binding (e.g., /logs/{log:slug})
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Approve log and deduct stock
     */
    public function approve()
    {
        if ($this->status !== 'pending') {
            return;
        }

        $this->update(['status' => 'approved']);

        if (!empty($this->items_used)) {
            foreach ($this->items_used as $used) {
                Stock::where('project_id', $this->project_id)
                    ->where('item_id', $used['item_id'])
                    ->decrement('stock', $used['quantity']);
            }
        }
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
