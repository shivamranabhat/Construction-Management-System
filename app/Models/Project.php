<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'code',
        'client',
        'start_date',
        'end_date',
        'budget',
        'status',
        'slug',
    ];
}
