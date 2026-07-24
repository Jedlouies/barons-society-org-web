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

        // Fetch active announcements
        $announcementsResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl . '/rest/v1/announcements?select=*&active=eq.true&order=created_at.desc'
        );

        // Fetch latest news
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
}