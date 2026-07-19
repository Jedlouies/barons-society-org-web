<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    protected string $supabaseUrl;
    protected string $supabaseKey;

    public function __construct()
    {
        $this->supabaseUrl = env('SUPABASE_URL');
        $this->supabaseKey = env('SUPABASE_ANON_KEY');
    }

    public function index()
    {
        // Active announcements
        $announcementsResponse = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get(
            $this->supabaseUrl .
            '/rest/v1/announcements?select=*&active=eq.true&order=created_at.desc'
        );

        // Latest news
        $newsResponse = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get(
            $this->supabaseUrl .
            '/rest/v1/news?select=*&order=published_date.desc'
        );

        return view('blogs', [
            'announcements' => $announcementsResponse->successful()
                ? $announcementsResponse->json()
                : [],
            'news' => $newsResponse->successful()
                ? $newsResponse->json()
                : [],
        ]);
    }

    public function show($slug)
    {
        // Get the news article
        $newsResponse = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get(
            $this->supabaseUrl .
            '/rest/v1/news?slug=eq.' . urlencode($slug) . '&select=*'
        );

        $article = $newsResponse->json()[0] ?? null;

        if (!$article) {
            abort(404);
        }

        // Get gallery images for the article
        $imagesResponse = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get(
            $this->supabaseUrl .
            '/rest/v1/news_images?news_id=eq.' .
            $article['id'] .
            '&select=*&order=display_order.asc'
        );

        return view('news-details', [
            'article' => $article,
            'images' => $imagesResponse->successful()
                ? $imagesResponse->json()
                : [],
        ]);
    }
}