<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Register gates ONCE per request, AFTER auth
    Gate::after(function ($user, $ability) {
        // This runs AFTER every Gate check
        if ($user->type === 'Company') {
            return true; // Company Owner bypasses ALL permissions
        }

        return null; // Let normal check proceed
    });

    // Register gates dynamically — but WITHOUT capturing auth()->user()
    if (!app()->has('permission.gates.registered')) {
        app()->instance('permission.gates.registered', true);

        Permission::with('module')->get()->each(function ($permission) {
            $ability = $permission->slug; // e.g., create-requisition

            Gate::define($ability, function ($user) use ($permission) {
                // This runs at runtime — $user is real authenticated user
                return $user->roles()
                    ->whereHas('permissions', fn($q) => $q->where('permissions.id', $permission->id))
                    ->exists();
            });
        });
    }
}
}
