<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
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

}
