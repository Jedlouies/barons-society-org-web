<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupabaseAuthService;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected SupabaseAuthService $authService;

    public function __construct(SupabaseAuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show the login view.
     */
    public function showLoginForm()
    {
        if (Session::has('supabase_token')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle login submission.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $result = $this->authService->signInWithPassword($request->email, $request->password);

        if (isset($result['error'])) {
            return back()->withInput($request->only('email'))->with('error', $result['error']);
        }

        if (isset($result['access_token'])) {
            Session::put('supabase_token', $result['access_token']);
            Session::put('supabase_user', $result['user'] ?? []);

            return redirect()->intended(route('dashboard'))->with('success', 'Logged in successfully!');
        }

        return back()->withInput($request->only('email'))->with('error', 'Authentication failed.');
    }

    /**
     * Handle logout.
     */
    public function logout()
    {
        Session::forget(['supabase_token', 'supabase_user']);
        Session::invalidate();
        Session::regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}