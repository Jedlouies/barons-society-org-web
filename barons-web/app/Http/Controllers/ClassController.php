<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ClassController extends Controller
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
    $headers = [
        'apikey' => $this->supabaseKey,
        'Authorization' => 'Bearer ' . $this->supabaseKey,
    ];

    // Get all classes
    $classesResponse = Http::withHeaders($headers)->get(
        $this->supabaseUrl .
        '/rest/v1/classes?select=*&order=class_number.asc'
    );

    $classes = $classesResponse->successful()
        ? $classesResponse->json()
        : [];

    foreach ($classes as &$class) {

        // Get Corps Commander
        $commanderResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl .
            '/rest/v1/members?id=eq.' .
            $class['corps_commander'] .
            '&select=first_name,last_name'
        );

        $commander = $commanderResponse->successful()
            ? ($commanderResponse->json()[0] ?? null)
            : null;

        $class['commander'] = $commander;

        // Get Members of the Class
        $membersResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl .
            '/rest/v1/members?class_id=eq.' .
            $class['id'] .
            '&select=*',
            
        );

        $class['members'] = $membersResponse->successful()
            ? $membersResponse->json()
            : [];
    }

    return view('classes', compact('classes'));
}
public function index2()
{
    $headers = [
        'apikey' => $this->supabaseKey,
        'Authorization' => 'Bearer ' . $this->supabaseKey,
    ];

    // Get all classes
    $classesResponse = Http::withHeaders($headers)->get(
        $this->supabaseUrl .
        '/rest/v1/classes?select=*&order=class_number.asc'
    );

    $classes = $classesResponse->successful()
        ? $classesResponse->json()
        : [];

    foreach ($classes as &$class) {

        // Get Corps Commander
        $commanderResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl .
            '/rest/v1/members?id=eq.' .
            $class['corps_commander'] .
            '&select=first_name,last_name'
        );

        $commander = $commanderResponse->successful()
            ? ($commanderResponse->json()[0] ?? null)
            : null;

        $class['commander'] = $commander;

        // Get Members of the Class
        $membersResponse = Http::withHeaders($headers)->get(
            $this->supabaseUrl .
            '/rest/v1/members?class_id=eq.' .
            $class['id'] .
            '&select=*',
            
        );

        $class['members'] = $membersResponse->successful()
            ? $membersResponse->json()
            : [];
    }

    return view('logclasses', compact('classes'));
}
}