<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class RequisitionApproval extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    
    protected $fillable = ['company_id', 'requisition_id', 'approver_id', 'level', 'status', 'comments', 'approved_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}