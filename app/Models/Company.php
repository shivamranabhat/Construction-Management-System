<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'currency',
        'slug',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function boqs()
    {
        return $this->hasMany(Boq::class);
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }
}
