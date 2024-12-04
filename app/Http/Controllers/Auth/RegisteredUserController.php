<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Base validation for common fields
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'max:15'],
            'role' => ['required', 'string', 'in:member,caregiver,volunteer,partner,admin'], // Ensure valid role
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Validate location only if not an Admin
        if ($request->role !== 'admin') {
            $request->validate([
                'location' => ['required', 'string', 'max:255'],
            ]);
        }

        // Validate age based on role
        if ($request->role === 'member' && $request->age < 45) {
            return back()->withErrors(['age' => 'Members must be 45 years or older.']);
        }

        if ($request->role === 'volunteer' && $request->age > 40) {
            return back()->withErrors(['age' => 'Volunteers must be under 40 years old.']);
        }

        // Validate disability field for Members only (Optional for Members, not required for others)
        if ($request->role === 'member' && $request->has('disability') && !empty($request->disability)) {
            $request->validate([
                'disability' => ['nullable', 'string', 'max:255'],
            ]);
        } else {
            $request->merge(['disability' => null]); // Set disability to null for non-members
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'location' => $request->location ?? null, // Location is nullable for Admin
            'age' => $request->age ?? null,           // Age is nullable for Admin and Caregiver
            'disability' => $request->disability ?? null, // Disability is nullable for non-members
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Fire the Registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard or role-specific page
        return redirect()->route('dashboard');
    }
}
