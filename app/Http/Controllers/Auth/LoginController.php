<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $ip = $request->ip();
        $email = $request->email;
        $key = 'login_attempts:' . $ip . ':' . $email;

        // Check rate limit
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik."
            ])->onlyInput('email');
        }

        // Attempt authentication
        $user = \App\Models\User::where('email', $email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Clear rate limit on success
            RateLimiter::clear($key);
            Cache::forget('failed_login_' . $ip);

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            // Log successful login
            ActivityLog::log('Auth', $user->id, 'Login', "User logged in from IP: {$ip}");

            return redirect()->intended('/admin/dashboard');
        }

        // Record failed attempt
        RateLimiter::hit($key, 60);
        
        $failedAttempts = Cache::get('failed_login_' . $ip, 0);
        Cache::put('failed_login_' . $ip, $failedAttempts + 1, 3600);

        // Log failed attempt
        ActivityLog::log('Auth', null, 'Failed Login', "Failed login attempt from IP: {$ip} with email: {$email}");

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        ActivityLog::log('Auth', auth()->id(), 'Logout', "User logged out");
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}