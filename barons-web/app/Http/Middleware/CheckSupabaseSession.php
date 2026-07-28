<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckSupabaseSession
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !$request->session()->has('supabase_access_token')) {
            return
              $this->forceLogout($request, 'Session Expired');
        }

        $accessToken = $request>session()->get('supabase_access_token');
        $refreshToken = $request>session()->get('supabase_refresh_token');
        $supabaseUrl  = rtrim(config('services.supabase.url', env('SUPABASE_URL')), '/');
        $supabaseKey  = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        if (!$supabaseUrl || !$supabaseKey) {
            return $next($request);
        }

        $verify = Http::withoutVerifying()
        ->withHeaders([
            'apikey' => $supabaseKey,
            'Authorization' => 'Bearer' . $accessToken,
        ])->get("{$supabaseUrl}/auth/v1/user");

        if ($verify->successful()) {
            return $next($request);
        }

        if ($refreshToken) {
            $refresh = Http::withoutVerifying()
            ->withHeaders([
                'apikey'=> $supabaseKey,
                'Authorization' => 'Bearer' . $accessToken,
            ])->post("{$supabaseUrl}/auth/v1/token?grant_type=refresh_token", [
                'refresh_token' => $refreshToken,
            ]); 
            
            if ($refresh->successful()) {
                $data = $refresh->json();
            

            $request->session()->put('supabase_access_token', $data['access_token']);
            $request->session()->put('supabase_refresh_token', $data['refresh_token'] ?? $refreshToken);

            return $next($request);
            }
        }
        
        return $this->forceLogout($request, 'Session Expired');

    }

    private function forceLogout(Request $request, string $message): Response
    {
        $accessToken = $request->session()->get('supabase_access_token');
        $supabaseUrl = rtrim(config('services.supabase.url', env('SUPABASE_URL')), '/');
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        if ($accessToken && $supabaseUrl && $supabaseKey) {
            try {
                Http::withoutVerifying()
                    ->withHeaders([
                        'apikey'        => $supabaseKey,
                        'Authorization' => 'Bearer ' . $accessToken,
                    ])
                    ->post("{$supabaseUrl}/auth/v1/logout");
            } catch (\Exception $e) {
                Log::warning('Supabase logout request failed: ' . $e->getMessage());
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withErrors([
            'email' => $message,
        ]);
    }

    
}
