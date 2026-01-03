<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Events\UserRegistered;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on role
            $role = strtolower(trim($user->role));
            switch ($role) {
                case 'admin':
                    // Admin roles: club, school, university
                    return redirect()->route('admin.dashboard');
                
                case 'super_admin':
                case 'superadmin': // Handle both
                    // Super Admin roles: nation, provincy, city
                    return redirect()->route('superadmin.dashboard'); 

                case 'operator':
                    // System Operator
                    return redirect()->route('operator.dashboard');

                default:
                    // For users with unrecognized roles, redirect to admin dashboard
                    // This allows registered users to access admin features
                    return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Check if the user was on an operator page and redirect accordingly
        $referer = $request->headers->get('referer');
        if ($referer && str_contains($referer, 'operator')) {
            return redirect()->route('login.operator');
        }

        return redirect()->route('login');
    }
    /**
     * Handle registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|string',
            'subrole' => 'nullable|string'
        ]);

        $user = \App\Models\User::create([
            'name' => explode('@', $request->email)[0], // Use email prefix as default name
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
            'sub_role' => $request->subrole ?? null,
        ]);

        // Fire event for new user registration
        event(new UserRegistered($user));

        // Send Welcome Email
        try {
            Mail::to($user->email)->send(new \App\Mail\UserWelcomeMail($user));
        } catch (\Exception $e) {
            \Log::error('Welcome email failed: ' . $e->getMessage());
        }

        // Auth::login($user); // Disable auto-login
        // $request->session()->regenerate();

        return redirect()->back()->with('registration_success', true);
    }

    /**
     * Handle registration with Google OAuth
     */
    public function registerWithGoogle(Request $request)
    {
        $validated = $request->validate([
            'google_id' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'nullable|string',
            'role' => 'required|string',
            'subrole' => 'nullable|string'
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'google_id' => $request->google_id,
            'avatar' => $request->avatar,
            'password' => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(24)), // Random password for Google users
            'role' => $request->role,
            'sub_role' => $request->subrole ?? null,
            'email_verified_at' => now(),
        ]);

        // Clear Google user session
        $request->session()->forget('google_user');
        $request->session()->forget('google_registration');

        // Fire event for new user registration
        event(new UserRegistered($user));

        // Send Welcome Email
        try {
            Mail::to($user->email)->send(new \App\Mail\UserWelcomeMail($user));
        } catch (\Exception $e) {
            \Log::error('Welcome email failed: ' . $e->getMessage());
        }

        // Auto-login after registration
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect based on role
        $originalRole = $user->role;
        $role = strtolower(trim($user->role ?? ''));
        \Log::info('Google registration routing', [
            'user_id' => $user->id,
            'original_role' => $originalRole,
            'processed_role' => $role,
            'role_type' => gettype($role)
        ]);
        
        switch ($role) {
            case 'admin':
                \Log::info('Redirecting new Google user to admin dashboard');
                return redirect()->route('admin.dashboard');
            
            case 'super_admin':
                \Log::info('Redirecting new Google user to superadmin dashboard (super_admin)');
                return redirect()->route('superadmin.dashboard');
                
            case 'superadmin':
                \Log::info('Redirecting new Google user to superadmin dashboard (superadmin)');
                return redirect()->route('superadmin.dashboard'); 

            case 'operator':
                \Log::info('Redirecting new Google user to operator dashboard');
                return redirect()->route('operator.dashboard');

            default:
                \Log::warning('Unknown role for new Google user, redirecting to admin dashboard', [
                    'role' => $role,
                    'original_role' => $originalRole
                ]);
                return redirect()->route('admin.dashboard');
        }
    }
}
