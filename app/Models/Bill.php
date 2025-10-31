<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'bill_date',
        'bill_number',
        'entered_by',
        'project_id',
        'company_id',
        'vendor_id',
        'status',
        'total_price',
        'notes',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany(BillProduct::class);
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

    public function enteredBy()
    {
        return $this->belongsTo(User::class, 'entered_by');
    }
}
