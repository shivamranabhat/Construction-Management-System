<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Module extends Model
{
    protected $fillable = [
        'name',
        'company_id',
        'slug',
    ];
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id');
    }

    
}
