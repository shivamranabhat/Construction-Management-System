<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;

class Bill extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);
    }
    
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
