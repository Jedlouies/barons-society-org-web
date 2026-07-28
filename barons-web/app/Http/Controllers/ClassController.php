<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ClassController extends Controller
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
        $classes = $this->fetchClassesWithMembers();
        return view('classes', compact('classes'));
    }

    public function index2()
    {
        $classes = $this->fetchClassesWithMembers();
        return view('logclasses', compact('classes'));
    }

    private function fetchClassesWithMembers(): array
    {
        $headers = [
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Accept'        => 'application/json',
        ];

        $classesResponse = Http::withHeaders($headers)
            ->get($this->supabaseUrl . '/rest/v1/classes?select=*&order=class_number.asc');

        if (!$classesResponse->successful()) {
            return [];
        }

        $classes = $classesResponse->json();
        if (empty($classes)) {
            return [];
        }

        $membersResponse = Http::withHeaders($headers)
            ->get($this->supabaseUrl . '/rest/v1/members?select=*&order=last_name.asc,first_name.asc');

        $allMembers = $membersResponse->successful() ? collect($membersResponse->json()) : collect();

        $membersById = $allMembers->keyBy('id');
        $membersByClass = $allMembers->groupBy('class_id');

        foreach ($classes as &$class) {
            $commanderId = $class['corps_commander'] ?? null;
            $class['commander'] = $commanderId && isset($membersById[$commanderId])
                ? [
                    'first_name' => $membersById[$commanderId]['first_name'] ?? '',
                    'last_name'  => $membersById[$commanderId]['last_name'] ?? '',
                ]
                : null;

            $class['corps_commander'] = $class['commander'] 
                ? $class['commander']['first_name'] . ' ' . $class['commander']['last_name']
                : ($class['corps_commander'] ?? 'N/A');

            $class['members'] = $membersByClass->get($class['id'], collect())->values()->all();
        }

        return $classes;
    }
}