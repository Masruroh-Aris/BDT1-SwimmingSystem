<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    /**
     * Helper: Redirect user based on their role strictly.
     * Menggunakan strtolower dan trim untuk memastikan string role cocok.
     */
    private function redirectBasedOnRole($user)
    {
        // Normalisasi string role: hapus spasi, jadikan huruf kecil
        $role = strtolower(trim($user->role ?? ''));

        // Log untuk debugging jika masih ada masalah
        Log::info('Redirecting user based on role', [
            'user_id' => $user->id,
            'role_raw' => $user->role,
            'role_processed' => $role
        ]);

        // Pengecekan ketat role
        if ($role === 'superadmin' || $role === 'super_admin') {
            return redirect()->route('superadmin.dashboard');
        }

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'operator') {
            return redirect()->route('operator.dashboard');
        }

        // Default fallback jika role tidak dikenali
        return redirect()->route('operator.dashboard');
    }

    /**
     * Redirect to Google OAuth (LOGIN FLOW)
     * Hanya redirect biasa tanpa menyimpan session role baru.
     */
    public function redirectToGoogle()
    {
        $redirect = env('GOOGLE_REDIRECT_URI') ?: config('services.google.redirect');
        
        return Socialite::driver('google')
            ->redirectUrl($redirect)
            ->redirect();
    }

    /**
     * Handle Google OAuth callback (LOGIN FLOW)
     * Digunakan untuk user yang sudah punya akun.
     */
    public function handleGoogleCallback()
    {
        try {
            // Use explicit redirect URI from env/config to match what was sent in redirectToGoogle
            $redirect = env('GOOGLE_REDIRECT_URI') ?: config('services.google.redirect');

            $googleUser = Socialite::driver('google')
                ->redirectUrl($redirect)
                ->user();

            // 1. Cari user berdasarkan Google ID
            $user = User::where('google_id', $googleUser->getId())->first();

            // 2. Jika tidak ketemu, cari berdasarkan email (mungkin daftar manual sebelumnya)
            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();
                if ($user) {
                    // Update user yang ada dengan Google ID
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }
            }

            // 3. User Ditemukan -> Login dan Redirect ke Dashboard
            if ($user) {
                Auth::login($user);
                return $this->redirectBasedOnRole($user);
            }

            // 4. User BEtUL-BETUL BARU tapi masuk lewat tombol LOGIN
            // Kita arahkan ke register role karena kita tidak tahu dia mau jadi apa (Admin/Operator dll)
            return redirect()->route('register.role')->withErrors(['google' => 'Akun tidak ditemukan. Silakan pilih role untuk mendaftar.']);

        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['google' => 'Gagal login dengan Google. Silakan coba lagi.']);
        }
    }

    /**
     * Redirect to Google OAuth (REGISTER FLOW)
     * Menangkap Role dan Sub-role dari URL/Input dan menyimpannya di Session.
     */
    public function redirectToGoogleRegister(Request $request)
    {
        // Simpan role yang dipilih user ke session
        if ($request->has('role')) {
            session(['register_role' => $request->input('role')]);
        }
        if ($request->has('subrole')) {
            session(['register_sub_role' => $request->input('subrole')]);
        }

        // Gunakan URI redirect khusus register
        $registerRedirect = env('GOOGLE_REGISTER_REDIRECT_URI') ?: (env('GOOGLE_REDIRECT_URI') ? rtrim(env('GOOGLE_REDIRECT_URI'), '/') . '/register/callback' : route('google.register.callback'));
        
        return Socialite::driver('google')
            ->redirectUrl($registerRedirect)
            ->redirect();
    }

    /**
     * Handle Google OAuth callback (REGISTER FLOW)
     * Membuat user baru berdasarkan data session Role.
     */
    public function handleGoogleRegisterCallback()
    {
        try {
            // Must use the SAME redirect URI as the one used in redirectToGoogleRegister
            $registerRedirect = env('GOOGLE_REGISTER_REDIRECT_URI') ?: (env('GOOGLE_REDIRECT_URI') ? rtrim(env('GOOGLE_REDIRECT_URI'), '/') . '/register/callback' : route('google.register.callback'));

            $googleUser = Socialite::driver('google')
                ->redirectUrl($registerRedirect)
                ->user();

            // 1. Cek apakah user sebenarnya sudah ada
            $existingUser = User::where('google_id', $googleUser->getId())
                                ->orWhere('email', $googleUser->getEmail())
                                ->first();

            if ($existingUser) {
                // Jika sudah ada, login saja
                if (!$existingUser->google_id) {
                    $existingUser->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }
                Auth::login($existingUser);
                return $this->redirectBasedOnRole($existingUser);
            }

            // 2. User Baru -> Cek Session untuk Role
            $role = session('register_role');
            $subRole = session('register_sub_role');

            if ($role) {
                // Buat User Baru Langsung
                $newUser = User::create([
                    'name' => $googleUser->getName() ?: explode('@', $googleUser->getEmail())[0],
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)),
                    'role' => $role,
                    'sub_role' => $subRole, 
                    'email_verified_at' => now(),
                ]);

                // Hapus session agar bersih
                session()->forget(['register_role', 'register_sub_role']);

                Auth::login($newUser);
                return $this->redirectBasedOnRole($newUser);
            }

            // 3. Fallback: Jika TIDAK ada role di session (user langsung akses URL callback?)
            // Arahkan kembali ke pemilihan role
            session(['google_user' => [
                'id' => $googleUser->getId(),
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]]);

            return redirect()->route('register.role');

        } catch (\Exception $e) {
            Log::error('Google register error: ' . $e->getMessage());
            return redirect()->route('register.role')->withErrors(['google' => 'Gagal mendaftar dengan Google. Silakan coba lagi.']);
        }
    }
}