<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;

class Purchase extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);
    }

    protected $fillable = [
        'purchase_date',
        'purchase_number',
        'vendor_id',
        'project_id',
        'entered_by',
        'company_id',
        'total_price',
        'status',
        'notes',
        'slug',
    ];


    public function products()
    {
        return $this->hasMany(PurchaseProduct::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function enteredBy()
    {
        return $this->belongsTo(User::class, 'entered_by');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
