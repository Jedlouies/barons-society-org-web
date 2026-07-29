<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalMembers = User::count() ?: 500;
        } catch (Exception $e) {
            $totalMembers = 500;
        }

        $announcements = collect();
        $classes       = collect();

        $supabaseUrl = config('services.supabase.url', env('SUPABASE_URL'));
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        if ($supabaseUrl && $supabaseKey) {
            $supabaseUrl = rtrim($supabaseUrl, '/');

            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'apikey'        => $supabaseKey,
                    'Authorization' => 'Bearer ' . $supabaseKey,
                ])->get("{$supabaseUrl}/rest/v1/announcements", [
                    'select'    => '*',
                    'is_active' => 'eq.true',
                    'or'        => '(expires_at.is.null,expires_at.gte.' . now()->toISOString() . ')',
                    'order'     => 'created_at.desc',
                    'limit'     => 5,
                ]);

                if ($response->successful()) {
                    $announcements = collect($response->json())->map(function ($item) {
                        return (object) [
                            'id'         => $item['id'] ?? null,
                            'title'      => $item['title'] ?? '',
                            'content'    => $item['content'] ?? '',
                            'type'       => $item['type'] ?? 'general',
                            'is_active'  => $item['is_active'] ?? true,
                            'expires_at' => isset($item['expires_at']) ? \Carbon\Carbon::parse($item['expires_at']) : null,
                            'created_at' => isset($item['created_at']) ? \Carbon\Carbon::parse($item['created_at']) : now(),
                        ];
                    });
                }
            } catch (Exception $e) {
                $announcements = collect();
            }

            try {
                $classResponse = Http::withoutVerifying()->withHeaders([
                    'apikey'        => $supabaseKey,
                    'Authorization' => 'Bearer ' . $supabaseKey,
                ])->get("{$supabaseUrl}/rest/v1/classes", [
                    'select' => 'id, class_name, class_number, batch_year',
                    'order'  => 'class_number.asc',
                ]);

                if ($classResponse->successful()) {
                    $classes = collect($classResponse->json());
                }
            } catch (Exception $e) {
                $classes = collect();
            }
        }

        $totalClasses   = $classes->count() ?: 12;
        $totalBlogs     = 8;
        $totalPhotos    = 45;
        $memberPosition = session('member_position', 'Active Alumni Member');
        $memberDetails  = session('member_details', null);

        return view('dashboard', compact(
            'totalMembers',
            'totalClasses',
            'totalBlogs',
            'totalPhotos',
            'announcements',
            'classes',
            'memberPosition',
            'memberDetails'
        ));
    }

    public function storeAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'type'       => 'required|string|in:general,urgent',
            'content'    => 'required|string',
            'expires_at' => 'nullable|date',
        ]);

        $supabaseUrl = config('services.supabase.url', env('SUPABASE_URL'));
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        if ($supabaseUrl && $supabaseKey) {
            $payload = [
                'title'     => $validated['title'],
                'type'      => $validated['type'],
                'content'   => $validated['content'],
                'is_active' => true,
                'expires_at'=> !empty($validated['expires_at']) ? \Carbon\Carbon::parse($validated['expires_at'])->toIso8601String() : null,
            ];

            $response = Http::withHeaders([
                'apikey'        => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
                'Content-Type'  => 'application/json',
                'Prefer'        => 'return=minimal',
            ])->post("{$supabaseUrl}/rest/v1/announcements", $payload);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Announcement published successfully.');
            }
        }

        return redirect()->back()->withErrors(['error' => 'Failed to publish announcement.']);
    }

    public function storeMember(Request $request)
    {
        $validated = $request->validate([
            'class_id'       => 'nullable|string',
            'cadet_role'     => 'required|string|max:100',
            'first_name'     => 'required|string|max:100',
            'middle_name'    => 'nullable|string|max:100',
            'last_name'      => 'required|string|max:100',
            'suffix'         => 'nullable|string|max:20',
            'nickname'       => 'nullable|string|max:100',
            'gender'         => 'nullable|string|max:20',
            'birth_date'     => 'nullable|date',
            'civil_status'   => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'city'           => 'nullable|string|max:100',
            'province'       => 'nullable|string|max:100',
            'country'        => 'nullable|string|max:100',
            'contact_number' => 'nullable|string|max:30',
            'email'          => 'required|email|max:255',
            'occupation'     => 'nullable|string|max:255',
            'company'        => 'nullable|string|max:255',
            'business_name'  => 'nullable|string|max:255',
            'facebook_url'   => 'nullable|url|max:500',
            'profile_photo'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $supabaseUrl = config('services.supabase.url', env('SUPABASE_URL'));
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        if (!$supabaseUrl || !$supabaseKey) {
            return redirect()->back()->withErrors(['member_error' => 'Supabase configuration missing.'])->withInput();
        }

        $supabaseUrl = rtrim($supabaseUrl, '/');
        $profilePhotoUrl = null;

        if ($request->hasFile('profile_photo')) {
            try {
                $file      = $request->file('profile_photo');
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $fileName  = 'profile_' . time() . '_' . Str::random(8) . '.' . $extension;

                $uploadEndpoint = "{$supabaseUrl}/storage/v1/object/barons-images/{$fileName}";

                $uploadResponse = Http::withoutVerifying()->withHeaders([
                    'apikey'        => $supabaseKey,
                    'Authorization' => 'Bearer ' . $supabaseKey,
                    'Content-Type'  => $file->getMimeType() ?: 'image/jpeg',
                    'x-upsert'      => 'true',
                ])->withBody(
                    file_get_contents($file->getRealPath()), 
                    $file->getMimeType() ?: 'image/jpeg'
                )->post($uploadEndpoint);

                if ($uploadResponse->successful()) {
                    $profilePhotoUrl = "{$supabaseUrl}/storage/v1/object/public/barons-images/{$fileName}";
                } else {
                    Log::error('Member profile photo upload failed', [
                        'status' => $uploadResponse->status(),
                        'body'   => $uploadResponse->body(),
                    ]);
                }
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['member_error' => 'Photo Upload Failed: ' . $e->getMessage()])->withInput();
            }
        }

        $payload = [
            'class_id'       => !empty($validated['class_id']) ? $validated['class_id'] : null,
            'cadet_role'     => $validated['cadet_role'] ?? 'Members',
            'first_name'     => $validated['first_name'],
            'middle_name'    => !empty($validated['middle_name']) ? $validated['middle_name'] : null,
            'last_name'      => $validated['last_name'],
            'suffix'         => !empty($validated['suffix']) ? $validated['suffix'] : null,
            'nickname'       => !empty($validated['nickname']) ? $validated['nickname'] : null,
            'gender'         => !empty($validated['gender']) ? $validated['gender'] : null,
            'birth_date'     => !empty($validated['birth_date']) ? $validated['birth_date'] : null,
            'civil_status'   => !empty($validated['civil_status']) ? $validated['civil_status'] : null,
            'address'        => !empty($validated['address']) ? $validated['address'] : null,
            'city'           => !empty($validated['city']) ? $validated['city'] : null,
            'province'       => !empty($validated['province']) ? $validated['province'] : null,
            'country'        => !empty($validated['country']) ? $validated['country'] : 'Philippines',
            'contact_number' => !empty($validated['contact_number']) ? $validated['contact_number'] : null,
            'email'          => strtolower($validated['email']),
            'occupation'     => !empty($validated['occupation']) ? $validated['occupation'] : null,
            'company'        => !empty($validated['company']) ? $validated['company'] : null,
            'business_name'  => !empty($validated['business_name']) ? $validated['business_name'] : null,
            'facebook_url'   => !empty($validated['facebook_url']) ? $validated['facebook_url'] : null,
            'profile_photo'  => $profilePhotoUrl,
            'is_public'      => true,
        ];

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'apikey'        => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
                'Content-Type'  => 'application/json',
                'Prefer'        => 'return=minimal',
            ])->post("{$supabaseUrl}/rest/v1/members", $payload);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Member added successfully.');
            }

            $errorBody = $response->json();
            return redirect()->back()->withErrors([
                'member_error' => 'Supabase Error: ' . ($errorBody['message'] ?? $response->body())
            ])->withInput();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['member_error' => 'Connection Error: ' . $e->getMessage()])->withInput();
        }
    }

    public function storeClass(Request $request)
    {
        $validated = $request->validate([
            'class_name'      => 'required|string|max:50',
            'class_number'    => 'nullable|integer|min:1',
            'batch_year'      => 'nullable|integer',
            'corps_commander' => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'class_logo'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $supabaseUrl = config('services.supabase.url', env('SUPABASE_URL'));
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        if (!$supabaseUrl || !$supabaseKey) {
            return redirect()->back()->withErrors(['class_error' => 'Supabase URL or API Key is missing.']);
        }

        $supabaseUrl = rtrim($supabaseUrl, '/');
        $classLogoUrl = null;

        if ($request->hasFile('class_logo')) {
            try {
                $file      = $request->file('class_logo');
                $extension = $file->getClientOriginalExtension();
                $fileName  = 'classes/logo_' . time() . '_' . Str::random(8) . '.' . $extension;

                $uploadEndpoint = "{$supabaseUrl}/storage/v1/object/barons-images/{$fileName}";

                $uploadResponse = Http::withoutVerifying()->withHeaders([
                    'apikey'        => $supabaseKey,
                    'Authorization' => 'Bearer ' . $supabaseKey,
                    'Content-Type'  => $file->getMimeType(),
                    'x-upsert'      => 'true',
                ])->withBody(
                    file_get_contents($file->getRealPath()),
                    $file->getMimeType()
                )->post($uploadEndpoint);

                if ($uploadResponse->successful()) {
                    $classLogoUrl = "{$supabaseUrl}/storage/v1/object/public/barons-images/{$fileName}";
                } else {
                    $errorMsg = $uploadResponse->json()['message'] ?? $uploadResponse->body();
                    return redirect()->back()->withErrors(['class_error' => 'Logo Upload Failed: ' . $errorMsg]);
                }
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['class_error' => 'Logo Upload Exception: ' . $e->getMessage()]);
            }
        }

        $payload = [
            'class_name'      => $validated['class_name'],
            'class_number'    => !empty($validated['class_number']) ? (int) $validated['class_number'] : null,
            'batch_year'      => !empty($validated['batch_year']) ? (int) $validated['batch_year'] : null,
            'corps_commander' => !empty($validated['corps_commander']) ? $validated['corps_commander'] : null,
            'description'     => !empty($validated['description']) ? $validated['description'] : null,
            'class_logo'      => $classLogoUrl,
        ];

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'apikey'        => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
                'Content-Type'  => 'application/json',
                'Prefer'        => 'return=minimal',
            ])->post("{$supabaseUrl}/rest/v1/classes", $payload);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'New class created successfully.');
            }

            $errorBody = $response->json();
            $message   = $errorBody['message'] ?? $errorBody['hint'] ?? $response->body();

            return redirect()->back()->withErrors(['class_error' => 'Supabase Error: ' . $message]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['class_error' => 'Connection Exception: ' . $e->getMessage()]);
        }
    }
}