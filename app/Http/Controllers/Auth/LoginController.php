<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Maksimal percobaan login gagal sebelum dikunci sementara.
     */
    protected const MAX_ATTEMPTS = 5;

    /**
     * Lama kunci (detik) setelah melebihi MAX_ATTEMPTS.
     */
    protected const DECAY_SECONDS = 60;

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     * Only admin accounts can login (all users in database are admins)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $throttleKey = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            // All users in database are admin, redirect to dashboard
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Login berhasil! Selamat datang, Admin.');
        }

        RateLimiter::hit($throttleKey, self::DECAY_SECONDS);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Kunci unik untuk rate limiting: kombinasi email + IP, supaya satu
     * IP tidak bisa brute force banyak email, dan satu email yang
     * diserang dari banyak IP tetap dibatasi per kombinasinya.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
