<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'type',
        'item_id',
        'quantity',
        'unit_cost',
        'date',
        'entered_by',
        'project_id',
        'company_id',
        'vendor_id',
        'status',
        'slug',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function enteredBy()
    {
        return $this->belongsTo(User::class, 'entered_by');
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
