<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    protected string $supabaseUrl;
    protected string $supabaseKey;

    public function __construct()
    {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL', ''), '/');
        $this->supabaseKey = env('SUPABASE_ANON_KEY', env('SUPABASE_KEY', ''));
    }

    public function index()
    {
        $headers = [
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Accept'        => 'application/json',
        ];

        $announcementsResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl . '/rest/v1/announcements?select=*&active=eq.true&order=created_at.desc'
        );

        $newsResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl . '/rest/v1/news?select=*&order=published_date.desc'
        );

        return view('blogs', [
            'announcements' => $announcementsResponse->successful() ? $announcementsResponse->json() : [],
            'news'          => $newsResponse->successful() ? $newsResponse->json() : [],
        ]);
    }

    public function show($slug)
    {
        $headers = [
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Accept'        => 'application/json',
        ];

        $newsResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl . '/rest/v1/news?slug=eq.' . urlencode($slug) . '&select=*'
        );

        $article = $newsResponse->successful() ? ($newsResponse->json()[0] ?? null) : null;

        if (!$article) {
            abort(404);
        }

        $imagesResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl . '/rest/v1/news_images?news_id=eq.' . $article['id'] . '&select=*&order=display_order.asc'
        );

        return view('news-details', [
            'article' => $article,
            'images'  => $imagesResponse->successful() ? $imagesResponse->json() : [],
        ]);
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

        $supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $supabaseKey = env('SUPABASE_KEY', env('SUPABASE_ANON_KEY'));
        $coverImageUrl = null;

        if ($request->hasFile('cover_image')) {
            try {
                $file = $request->file('cover_image');
                $filename = 'news_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                $storageResponse = Http::withHeaders([
                    'apikey'        => $supabaseKey,
                    'Authorization' => 'Bearer ' . $supabaseKey,
                ])->attach(
                    'file', file_get_contents($file->getRealPath()), $filename
                )->post("{$supabaseUrl}/storage/v1/object/news-covers/{$filename}");

                if ($storageResponse->successful()) {
                    $coverImageUrl = "{$supabaseUrl}/storage/v1/object/public/news-covers/{$filename}";
                } else {
                    Log::warning('Supabase Storage upload failed: ' . $storageResponse->body());
                }
            } catch (\Exception $e) {
                Log::error('Error uploading cover image: ' . $e->getMessage());
            }
        }

        $slug = Str::slug($validated['title']) . '-' . Str::random(5);

        $payload = [
            'title'          => $validated['title'],
            'slug'           => $slug,
            'summary'        => $validated['summary'] ?? null,
            'content'        => $validated['content'],
            'published_date' => $validated['published_date'],
            'featured'       => $request->has('featured') ? true : false,
            'cover_image'    => $coverImageUrl,
        ];

        $dbResponse = Http::withHeaders([
            'apikey'        => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation',
        ])->post("{$supabaseUrl}/rest/v1/news", $payload);

        if ($dbResponse->failed()) {
            return back()->withErrors(['news_error' => 'Failed to publish news article. Please try again.']);
        }

        return redirect()->route('blogs.index')->with('success', 'News article published successfully!');
    }
}