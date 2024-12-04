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
        // Authenticate the user
        $request->authenticate();

        // Regenerate the session
        $request->session()->regenerate();

        // Redirect based on role
        $user = Auth::user();
        return redirect()->intended($this->redirectTo($user->role));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Determine the redirection route based on user role.
     */
    protected function redirectTo(string $role): string
    {
        switch ($role) {
            case 'member':
                return route('member.dashboard');
            case 'caregiver':
                return route('caregiver.dashboard');
            case 'volunteer':
                return route('volunteer.dashboard');
            case 'partner':
                return route('partner.dashboard');
            case 'admin':
                return route('admin.dashboard');
            default:
                return route('dashboard');
        }
    }
}
