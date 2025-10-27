<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!Auth::check()) {
            return redirect('/signin')->getTargetUrl();
        }
        if (Auth::check()) {
            // Store company_id in session for easy access
            if(Auth::user()->company_id) {
                session(['company_id' => Auth::user()->company_id]);
            }
        }
        return $next($request);
    }
}
