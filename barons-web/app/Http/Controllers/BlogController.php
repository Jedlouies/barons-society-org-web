<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $supabaseUrl = rtrim(config('services.supabase.url', env('SUPABASE_URL')), '/');
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        $news = [];

        if ($supabaseUrl && $supabaseKey) {
            try {
                $response = Http::withoutVerifying()
                    ->withHeaders([
                        'apikey'        => $supabaseKey,
                        'Authorization' => 'Bearer ' . $supabaseKey,
                    ])->get("{$supabaseUrl}/rest/v1/news", [
                        'select' => '*',
                        'order'  => 'published_date.desc,created_at.desc',
                    ]);

                if ($response->successful()) {
                    $news = $response->json();
                }
            } catch (\Exception $e) {
                Log::warning('Failed to fetch news from Supabase: ' . $e->getMessage());
            }
        }

        return view('blogs', compact('news'));
    }

    public function show($slug)
    {
        $supabaseUrl = rtrim(config('services.supabase.url', env('SUPABASE_URL')), '/');
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        $article = null;

        if ($supabaseUrl && $supabaseKey) {
            try {
                $response = Http::withoutVerifying()
                    ->withHeaders([
                        'apikey'        => $supabaseKey,
                        'Authorization' => 'Bearer ' . $supabaseKey,
                    ])->get("{$supabaseUrl}/rest/v1/news", [
                        'select' => '*',
                        'slug'   => 'eq.' . $slug,
                        'limit'  => 1,
                    ]);

                if ($response->successful() && !empty($response->json())) {
                    $article = $response->json()[0];
                }
            } catch (\Exception $e) {
                Log::warning('Failed to fetch article details: ' . $e->getMessage());
            }
        }

        if (!$article) {
            abort(404, 'Article not found');
        }

        return view('news-show', compact('article'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'summary'        => 'nullable|string',
            'content'        => 'required|string',
            'published_date' => 'required|date',
            'featured'       => 'nullable|boolean',
            'cover_image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $supabaseUrl = rtrim(config('services.supabase.url', env('SUPABASE_URL')), '/');
        $supabaseKey = config('services.supabase.anon_key', env('SUPABASE_ANON_KEY'));

        if (!$supabaseUrl || !$supabaseKey) {
            return back()->withErrors(['news_error' => 'Supabase URL or Key is missing in environment settings.']);
        }

        $coverImageUrl = null;

        // 1. Upload Cover Image to Supabase Storage ("news-covers" bucket)
        if ($request->hasFile('cover_image')) {
            try {
                $file = $request->file('cover_image');
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $filename = 'news_' . time() . '_' . Str::random(8) . '.' . $extension;

                $storageResponse = Http::withoutVerifying()
                    ->withHeaders([
                        'apikey'        => $supabaseKey,
                        'Authorization' => 'Bearer ' . $supabaseKey,
                    ])->attach(
                        'file', 
                        file_get_contents($file->getRealPath()), 
                        $filename
                    )->post("{$supabaseUrl}/storage/v1/object/news-covers/{$filename}");

                if ($storageResponse->successful()) {
                    $coverImageUrl = "{$supabaseUrl}/storage/v1/object/public/news-covers/{$filename}";
                } else {
                    Log::warning('Supabase Storage upload failed for news cover', [
                        'status' => $storageResponse->status(),
                        'body'   => $storageResponse->body(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Error uploading news cover image: ' . $e->getMessage());
            }
        }

        // 2. Insert Record into Supabase `public.news` Table
        $slug = Str::slug($validated['title']) . '-' . Str::random(6);

        $payload = [
            'title'          => $validated['title'],
            'slug'           => $slug,
            'summary'        => $validated['summary'] ?? null,
            'content'        => $validated['content'],
            'published_date' => $validated['published_date'],
            'featured'       => $request->has('featured') ? true : false,
            'cover_image'    => $coverImageUrl,
        ];

        $dbResponse = Http::withoutVerifying()
            ->withHeaders([
                'apikey'        => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
                'Content-Type'  => 'application/json',
                'Prefer'        => 'return=representation',
            ])->post("{$supabaseUrl}/rest/v1/news", $payload);

        if ($dbResponse->failed()) {
            Log::error('Failed to insert news entry into Supabase database', [
                'status' => $dbResponse->status(),
                'body'   => $dbResponse->body(),
            ]);

            return back()->withErrors(['news_error' => 'Database insert failed: ' . ($dbResponse->json()['message'] ?? $dbResponse->body())])->withInput();
        }

        return redirect()->route('blogs.index')->with('success', 'News article published successfully!');
    }
}