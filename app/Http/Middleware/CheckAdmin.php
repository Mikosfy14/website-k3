<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Kalau user belum login → redirect ke halaman login
        if (!$user) {
            return redirect()->route('login');
        }

        // Panggil isAdmin() langsung pada object user
        if (!$user->isAdmin()) {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}
