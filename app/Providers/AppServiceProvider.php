<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use Illuminate\Auth\Access\Gate as IlluminateGate;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // This runs AFTER every single @can(), Gate::allows(), etc.
        Gate::after(function ($user, $ability) {
            if ($user && $user->type === 'Company') {
                return true; // Company bypasses ALL permissions
            }

            // For regular users: check if any role has this permission
            return $user->roles()->whereHas('permissions', function ($q) use ($ability) {
                $q->where('slug', $ability);
            })->exists();
        });
    }

   
}