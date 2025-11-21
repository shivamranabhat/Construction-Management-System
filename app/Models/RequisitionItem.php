<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class RequisitionItem extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    protected $fillable = ['company_id', 'requisition_id', 'item_id', 'quantity', 'unit', 'remarks'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}