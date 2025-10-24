<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;

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
        Gate::define('super_admin', function (User $user) {
            return $user->type === 'Super Admin'; // or `$user->type == Super Admin;` 
        });
        Gate::define('company', function (User $user) {
            return $user->type === 'company'; // or `$user->type == company;` 
        });
    }
}
