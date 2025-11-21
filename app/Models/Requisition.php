<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;

class Requisition extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);
    }

    protected $fillable = [
        'company_id', 'requisition_number', 'project_id', 'requested_by',
        'required_date', 'purpose', 'status', 'rejection_reason'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function items()
    {
        return $this->hasMany(RequisitionItem::class);
    }

    public function approvals()
    {
        return $this->hasMany(RequisitionApproval::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getTotalEstimatedValueAttribute()
    {
        return $this->items->sum(fn($i) => $i->quantity * ($i->item->estimated_price ?? 0));
    }

    public static function generateRequisitionNumber()
    {
        $prefix = 'REQ-';
        $latest = self::where('requisition_number', 'like', $prefix . '%')
                      ->orderBy('created_at', 'desc')
                      ->first();

        if (!$latest) {
            return $prefix . '0001';
        }

        $lastNumber = (int) Str::after($latest->requisition_number, $prefix);
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return $prefix . $newNumber;
    }
}