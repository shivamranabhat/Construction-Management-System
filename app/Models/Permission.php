<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Permission extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    
    protected $fillable = [
        'name',
        'module_id',
        'company_id',
        'slug',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
