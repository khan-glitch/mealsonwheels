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

        // Get the user and redirect based on their role
        $user = Auth::user();

        return $this->redirectTo($user->role);
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
     * Determine the redirection route based on the user's role.
     */
    protected function redirectTo(string $role): RedirectResponse
    {
        switch ($role) {
            case 'member':
                return redirect()->route('member.dashboard');
            case 'caregiver':
                return redirect()->route('caregiver.dashboard');
            case 'volunteer':
                return redirect()->route('volunteer.dashboard');
            case 'partner':
                return redirect()->route('partner.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            default:
                return redirect()->route('dashboard');
        }
    }
}
