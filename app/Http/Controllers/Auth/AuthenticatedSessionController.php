<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(route('main.layout', absolute: false));
        if (Auth::check()) {
            if (Auth::user()->hasRole('Super Admin')) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->hasRole('Salesman')) {
                return redirect()->route('salesman.dashboard');
            }
        }

        // Fallback redirect if user is authenticated but no role matches
        // return redirect()->route('login')->withErrors(['email' => 'No matching role found.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}