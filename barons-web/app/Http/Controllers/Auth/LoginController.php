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
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
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
            $supabaseUrl = rtrim($supabaseUrl, '/');

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'apikey'       => $supabaseKey,
                    'Content-Type' => 'application/json',
                ])
                ->post("{$supabaseUrl}/auth/v1/token?grant_type=password", [
                    'email'    => $credentials['email'],
                    'password' => $credentials['password'],
                ]);

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

            $data         = $response->json();
            $accessToken  = $data['access_token'] ?? null;
            $refreshToken = $data['refresh_token'] ?? null;
            $expiresIn    = $data['expires_in'] ?? 3600; 
            $supabaseUser = $data['user'] ?? null;

            if (!$supabaseUser || empty($supabaseUser['email'])) {
                throw new \Exception('User payload missing or invalid from Supabase response.');
            }

            $userEmail  = strtolower($supabaseUser['email']);
            $memberData = null;

            try {
                $memberResponse = Http::withoutVerifying()
                    ->withHeaders([
                        'apikey'        => $supabaseKey,
                        'Authorization' => 'Bearer ' . $accessToken,
                    ])
                    ->get("{$supabaseUrl}/rest/v1/members", [
                        'select' => '*',
                        'email'  => 'eq.' . $userEmail,
                        'limit'  => 1,
                    ]);

                if ($memberResponse->successful() && !empty($memberResponse->json())) {
                    $memberData = $memberResponse->json()[0];
                }
            } catch (\Exception $e) {
                Log::warning('Failed to fetch member details from Supabase: ' . $e->getMessage());
            }

            $user = User::where('email', $userEmail)->first();

            if (!$user) {
                $user = new User();
                $user->email = $userEmail;
                $user->password = bcrypt(\Illuminate\Support\Str::random(24));
            }

            $memberFullName = null;
            if ($memberData) {
                $firstName = $memberData['first_name'] ?? '';
                $lastName  = $memberData['last_name'] ?? '';
                $memberFullName = trim("{$firstName} {$lastName}");
            }

            $user->name = !empty($memberFullName) 
                ? $memberFullName 
                : ($supabaseUser['user_metadata']['full_name'] ?? strstr($userEmail, '@', true));

            $user->email_verified_at = !empty($supabaseUser['email_confirmed_at']) ? now() : null;
            $user->save();

            Auth::login($user);

            $request->session()->regenerate();

            $request->session()->put('supabase_access_token', $accessToken);
            $request->session()->put('supabase_refresh_token', $refreshToken);
            $request->session()->put('supabase_user_id', $supabaseUser['id']);
            
            $request->session()->put('supabase_token_expires_at', now()->addSeconds($expiresIn)->timestamp);

            if ($memberData) {
                $request->session()->put('member_position', $memberData['position']);
                $request->session()->put('member_details', $memberData);
            }

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

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }
}