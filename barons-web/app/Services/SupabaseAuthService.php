<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupabaseAuthService
{
    protected string $url;
    protected string $anonKey;

    public function __construct()
    {
        $this->url = rtrim(config('services.supabase.url') ?? env('SUPABASE_URL', ''), '/');
        $this->anonKey = config('services.supabase.anon_key') ?? env('SUPABASE_ANON_KEY', '');
    }

    public function signInWithPassword(string $email, string $password): array
    {
        if (empty($this->url) || empty($this->anonKey)) {
            Log::error('Supabase credentials missing.');
            return ['error' => 'Authentication service is misconfigured.'];
        }

        $endpoint = "{$this->url}/auth/v1/token?grant_type=password";

        try {
            $response = Http::withHeaders([
                'apikey' => $this->anonKey,
                'Content-Type' => 'application/json',
            ])->timeout(15)->post($endpoint, [
                'email' => $email,
                'password' => $password,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            $errorBody = $response->json();
            $message = $errorBody['error_description'] ?? $errorBody['msg'] ?? 'Invalid credentials.';
            return ['error' => $message];
        } catch (\Exception $e) {
            Log::error('Supabase Auth Exception: ' . $e->getMessage());
            return ['error' => 'Could not connect to authentication service.'];
        }
    }
}