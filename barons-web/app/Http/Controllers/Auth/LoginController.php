<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SupabaseAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected SupabaseAuthService $authService;

    public function __construct(SupabaseAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        if (Session::has('supabase_access_token')) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $result = $this->authService->signInWithPassword($request->email, $request->password);

        if (isset($result['error'])) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => $result['error']
            ]);
        }

        if (isset($result['access_token'])) {
            $accessToken  = $result['access_token'];
            $refreshToken = $result['refresh_token'] ?? null;
            $expiresIn    = $result['expires_in'] ?? 3600;
            $supabaseUser = $result['user'] ?? [];

            Session::put('supabase_access_token', $accessToken);
            Session::put('supabase_refresh_token', $refreshToken);
            Session::put('supabase_token_expires_at', now()->addSeconds($expiresIn)->timestamp);
            Session::put('supabase_user', $supabaseUser);

            $supabaseUrl = rtrim(config('services.supabase.url', env('SUPABASE_URL')), '/');
            
            // Prioritize the service_role key to bypass any RLS blockers
            $apiKey = config('services.supabase.service_role', env('SUPABASE_SERVICE_ROLE_KEY', config('services.supabase.anon_key', env('SUPABASE_KEY', env('SUPABASE_ANON_KEY')))));

            $resolvedName     = 'Member';
            $resolvedPosition = 'Member';
            $memberData       = [];

            if ($supabaseUrl && $apiKey && !empty($supabaseUser['email'])) {
                try {
                    $userEmail = trim(strtolower($supabaseUser['email']));
                    
                    $memberResponse = Http::withoutVerifying()
                        ->withHeaders([
                            'apikey'        => $apiKey,
                            'Authorization' => 'Bearer ' . $apiKey,
                        ])
                        ->get("{$supabaseUrl}/rest/v1/members", [
                            'select' => '*',
                            'email'  => 'ilike.' . $userEmail,
                            'limit'  => 1,
                        ]);

                    Log::info('Supabase Member Lookup Response for ' . $userEmail . ':', [
                        'status' => $memberResponse->status(),
                        'body'   => $memberResponse->json(),
                    ]);

                    if ($memberResponse->successful() && !empty($memberResponse->json())) {
                        $memberData = $memberResponse->json()[0];
                        
                        // Extract name from columns: first_name + last_name, full_name, name, or nickname
                        $fullName = trim(($memberData['first_name'] ?? '') . ' ' . ($memberData['last_name'] ?? ''));
                        if (!empty($fullName)) {
                            $resolvedName = $fullName;
                        } elseif (!empty($memberData['full_name'])) {
                            $resolvedName = $memberData['full_name'];
                        } elseif (!empty($memberData['name'])) {
                            $resolvedName = $memberData['name'];
                        } elseif (!empty($memberData['nickname'])) {
                            $resolvedName = $memberData['nickname'];
                        } else {
                            $resolvedName = $supabaseUser['user_metadata']['name'] ?? $supabaseUser['email'];
                        }

                        $resolvedPosition = $memberData['position'] ?? $memberData['role'] ?? 'Member';
                    } else {
                        // Fallback to auth metadata if members table lookup returns empty
                        $resolvedName     = $supabaseUser['user_metadata']['name'] ?? $supabaseUser['user_metadata']['full_name'] ?? $supabaseUser['email'];
                        $resolvedPosition = $supabaseUser['user_metadata']['position'] ?? $supabaseUser['user_metadata']['role'] ?? 'Member';
                    }
                } catch (\Exception $e) {
                    Log::error('Exception while fetching member details: ' . $e->getMessage());
                }
            }

            // Save variables to session for application-wide access
            Session::put('member_name', $resolvedName);
            Session::put('member_position', $resolvedPosition);
            Session::put('member_role', strtolower($resolvedPosition));
            Session::put('member_details', $memberData);

            return redirect()->intended(route('dashboard'))->with('success', 'Logged in successfully!');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Invalid login credentials.'
        ]);
    }

    public function logout(Request $request)
    {
        $accessToken = Session::get('supabase_access_token');
        $supabaseUrl = rtrim(config('services.supabase.url', env('SUPABASE_URL')), '/');
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY', env('SUPABASE_KEY')));

        if ($accessToken && $supabaseUrl && $supabaseKey) {
            try {
                Http::withoutVerifying()
                    ->withHeaders([
                        'apikey'        => $supabaseKey,
                        'Authorization' => 'Bearer ' . $accessToken,
                    ])
                    ->post("{$supabaseUrl}/auth/v1/logout");
            } catch (\Exception $e) {
                Log::warning('Supabase logout failed: ' . $e->getMessage());
            }
        }

        Session::invalidate();
        Session::regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}