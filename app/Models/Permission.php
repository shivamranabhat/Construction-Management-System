<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'module_id',
        'slug',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
