<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Display the member login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Handle authentication attempt using Supabase Auth REST API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 1. Validate incoming form inputs
        $credentials = $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $supabaseUrl = config('services.supabase.url', env('SUPABASE_URL'));
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        if (!$supabaseUrl || !$supabaseKey) {
            Log::error('Supabase credentials missing in config or .env');
            return back()->withErrors([
                'email' => 'Authentication service misconfigured. Check SUPABASE_URL and SUPABASE_ANON_KEY in .env',
            ])->onlyInput('email');
        }

        try {
            // Trim URL to prevent trailing slash duplication
            $supabaseUrl = rtrim($supabaseUrl, '/');

            // 2. Query Supabase Auth API endpoint for password grant token
            $response = Http::withoutVerifying() // Prevents local cURL SSL issues
                ->withHeaders([
                    'apikey'       => $supabaseKey,
                    'Content-Type' => 'application/json',
                ])
                ->post("{$supabaseUrl}/auth/v1/token?grant_type=password", [
                    'email'    => $credentials['email'],
                    'password' => $credentials['password'],
                ]);

            // 3. Handle failed authentication response from Supabase
            if ($response->failed()) {
                $errorData = $response->json();
                $errorMessage = $errorData['error_description'] 
                    ?? $errorData['msg'] 
                    ?? 'Invalid email or password. Please try again.';

                Log::warning('Supabase login failed for email: ' . $credentials['email'], [
                    'status'   => $response->status(),
                    'response' => $errorData,
                ]);

                return back()->withErrors([
                    'email' => $errorMessage,
                ])->onlyInput('email');
            }

            // 4. Extract token & user data from Supabase response
            $data = $response->json();
            $accessToken  = $data['access_token'] ?? null;
            $refreshToken = $data['refresh_token'] ?? null;
            $supabaseUser = $data['user'] ?? null;

            if (!$supabaseUser || empty($supabaseUser['email'])) {
                throw new \Exception('User payload missing or invalid from Supabase response.');
            }

            // 5. Synchronize local Laravel user model safely
            $userEmail = strtolower($supabaseUser['email']);
            $user = User::where('email', $userEmail)->first();

            if (!$user) {
                $user = new User();
                $user->email = $userEmail;
                $user->name  = $supabaseUser['user_metadata']['full_name'] 
                    ?? strstr($userEmail, '@', true);
                $user->password = bcrypt(\Illuminate\Support\Str::random(24));
                $user->email_verified_at = !empty($supabaseUser['email_confirmed_at']) ? now() : null;
                $user->save();
            }

            // 6. Log in user locally in Laravel Session
            Auth::login($user, true);

            // 7. Store Supabase tokens in session
            $request->session()->put('supabase_access_token', $accessToken);
            $request->session()->put('supabase_refresh_token', $refreshToken);
            $request->session()->put('supabase_user_id', $supabaseUser['id']);

            $request->session()->regenerate();

            // 8. Redirect to the dashboard route
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            Log::error('Supabase Auth Controller Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors([
                'email' => 'Authentication failed: ' . $e->getMessage(),
            ])->onlyInput('email');
        }
    }

    /**
     * Log the member out of both Laravel and Supabase sessions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $supabaseUrl = config('services.supabase.url', env('SUPABASE_URL'));
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));
        $accessToken = $request->session()->get('supabase_access_token');

        if ($accessToken && $supabaseUrl && $supabaseKey) {
            try {
                $supabaseUrl = rtrim($supabaseUrl, '/');
                Http::withoutVerifying()
                    ->withHeaders([
                        'apikey'        => $supabaseKey,
                        'Authorization' => 'Bearer ' . $accessToken,
                    ])->post("{$supabaseUrl}/auth/v1/logout");
            } catch (\Exception $e) {
                Log::warning('Failed to invalidate Supabase token on logout: ' . $e->getMessage());
            }
        }

        // Clear Laravel auth session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }
}