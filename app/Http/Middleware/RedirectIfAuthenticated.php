<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            // arahkan user yang sudah login ke dashboard
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
