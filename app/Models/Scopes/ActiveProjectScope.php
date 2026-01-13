<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveProjectScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    // public function apply(Builder $builder, Model $model): void
    // {
    //     if (session()->has('active_project_id')) {
    //         $builder->where('project_id', session('active_project_id'));
    //     }
    // }
    public function apply(Builder $builder, Model $model): void
    {
        // Only apply if key exists (even if null)
        if (session()->has('active_project_id')) {
            $projectId = session('active_project_id');
            
            // Extra safety: if someone puts invalid value, don't crash
            if ($projectId !== null) {
                $builder->where('project_id', $projectId);
            }
            // if null → intentionally show all (by doing nothing)
        }
    }
}
