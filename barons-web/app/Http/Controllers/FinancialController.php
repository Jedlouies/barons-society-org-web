<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class FinancialController extends Controller
{
    /**
     * Category metadata dictionary defined directly in Controller (No Model Needed).
     */
    private static function categoryMeta(): array
    {
        return [
            // INFLOW CATEGORIES
            'dues'        => ['label' => 'Monthly Member Dues', 'badgeClass' => 'tag-dues', 'flow' => 'INCOME', 'icon' => '🤝'],
            'donation'    => ['label' => 'Donations', 'badgeClass' => 'tag-donation', 'flow' => 'INCOME', 'icon' => '🎁'],
            'project-inc' => ['label' => 'Gross Income from Projects', 'badgeClass' => 'tag-project-inc', 'flow' => 'INCOME', 'icon' => '🚀'],
            'fundraising' => ['label' => 'Fund Raising', 'badgeClass' => 'tag-fundraising', 'flow' => 'INCOME', 'icon' => '🎟️'],
            'merch'       => ['label' => 'Merchandise Sales', 'badgeClass' => 'tag-merch', 'flow' => 'INCOME', 'icon' => '👕'],

            // OUTFLOW CATEGORIES
            'wedding'     => ['label' => 'Wedding Assistance', 'badgeClass' => 'tag-wedding', 'flow' => 'EXPENSE', 'icon' => '💒'],
            'burial'      => ['label' => 'Burial Aid', 'badgeClass' => 'tag-burial', 'flow' => 'EXPENSE', 'icon' => '🕊️'],
            'meeting'     => ['label' => 'Meetings & Admin', 'badgeClass' => 'tag-meeting', 'flow' => 'EXPENSE', 'icon' => '🤝'],
            'school'      => ['label' => 'Donate to School', 'badgeClass' => 'tag-school', 'flow' => 'EXPENSE', 'icon' => '🏫'],
            'event'       => ['label' => 'Events', 'badgeClass' => 'tag-event', 'flow' => 'EXPENSE', 'icon' => '🎉'],
            'project-exp' => ['label' => 'Projects Expense', 'badgeClass' => 'tag-project-exp', 'flow' => 'EXPENSE', 'icon' => '🏗️'],
            'misc'        => ['label' => 'Miscellaneous', 'badgeClass' => 'tag-misc', 'flow' => 'EXPENSE', 'icon' => '⚙️'],
        ];
    }

    /**
     * Display the dynamic financial dashboard by fetching directly from Supabase REST API.
     */
    public function index(Request $request)
    {
        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY', env('SUPABASE_ANON_KEY'));

        // Fetch records directly from Supabase PostgREST API
        $transactions = $this->fetchFromSupabaseApi($request, $supabaseUrl, $supabaseKey);
        $allTransactions = $this->fetchAllFromSupabaseApi($supabaseUrl, $supabaseKey);

        // Overall Top Card Summaries (All-Time Cash Totals)
        $totalInflow = $allTransactions->where('flow_type', 'INCOME')->sum('amount');
        $totalOutflow = $allTransactions->where('flow_type', 'EXPENSE')->sum('amount');
        $netCash = $totalInflow - $totalOutflow;
        $monthlyDuesTotal = $allTransactions->where('flow_type', 'INCOME')
            ->where('category', 'dues')
            ->sum('amount');

        // Filter transactions specifically for breakdown percentage calculations based on request parameters
        $breakdownTransactions = $allTransactions->filter(function ($item) use ($request) {
            if (empty($item->transaction_date)) {
                return true;
            }

            $txDate = Carbon::parse($item->transaction_date)->format('Y-m-d');
            $txYear = Carbon::parse($item->transaction_date)->format('Y');

            // 1. If start_date and end_date range are provided
            if ($request->filled('start_date') && $request->filled('end_date')) {
                return $txDate >= $request->start_date && $txDate <= $request->end_date;
            }

            // 2. If fiscal year parameter is provided and not set to 'all'
            if ($request->filled('year') && $request->year !== 'all') {
                return $txYear == $request->year;
            }

            // Default: Include all transactions for All-Time Totals
            return true;
        });

        // Compute period totals for the filtered breakdown dataset
        $periodInflowTotal = $breakdownTransactions->where('flow_type', 'INCOME')->sum('amount');
        $periodOutflowTotal = $breakdownTransactions->where('flow_type', 'EXPENSE')->sum('amount');

        $inflowCategories = ['dues', 'donation', 'project-inc', 'fundraising', 'merch'];
        $outflowCategories = ['burial', 'school', 'project-exp', 'event', 'wedding', 'meeting', 'misc'];

        $categoryMeta = self::categoryMeta();

        // Compute Inflow Breakdown using filtered period data
        $inflowBreakdown = [];
        foreach ($inflowCategories as $catKey) {
            $amount = $breakdownTransactions->where('flow_type', 'INCOME')
                ->where('category', $catKey)
                ->sum('amount');
            
            $percentage = $periodInflowTotal > 0 ? round(($amount / $periodInflowTotal) * 100, 1) : 0;
            
            $inflowBreakdown[] = [
                'key'        => $catKey,
                'label'      => $categoryMeta[$catKey]['label'] ?? $catKey,
                'icon'       => $categoryMeta[$catKey]['icon'] ?? '💰',
                'amount'     => $amount,
                'percentage' => $percentage,
            ];
        }

        // Compute Outflow Breakdown using filtered period data
        $outflowBreakdown = [];
        foreach ($outflowCategories as $catKey) {
            $amount = $breakdownTransactions->where('flow_type', 'EXPENSE')
                ->where('category', $catKey)
                ->sum('amount');

            $percentage = $periodOutflowTotal > 0 ? round(($amount / $periodOutflowTotal) * 100, 1) : 0;

            $outflowBreakdown[] = [
                'key'        => $catKey,
                'label'      => $categoryMeta[$catKey]['label'] ?? $catKey,
                'icon'       => $categoryMeta[$catKey]['icon'] ?? '💸',
                'amount'     => $amount,
                'percentage' => $percentage,
            ];
        }

        // Extract distinct available transaction years from Supabase records
        $availableYears = $allTransactions->map(function ($item) {
            return !empty($item->transaction_date) ? Carbon::parse($item->transaction_date)->format('Y') : null;
        })->filter()->unique()->sortDesc()->values()->all();

        if (empty($availableYears)) {
            $availableYears = range(date('Y'), date('Y') - 5);
        }

        return view('financial', compact(
            'transactions',
            'totalInflow',
            'totalOutflow',
            'netCash',
            'monthlyDuesTotal',
            'inflowBreakdown',
            'outflowBreakdown',
            'categoryMeta',
            'availableYears'
        ));
    }

    /**
     * Store a new financial entry directly into Supabase via REST API.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'flow_type'        => 'required|in:INCOME,EXPENSE',
            'category'         => 'required|string|max:50',
            'amount'           => 'required|numeric|min:0.01',
            'payee_or_source'  => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $validated['recorded_by'] = auth()->user()->name ?? 'Treasury Officer';

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY', env('SUPABASE_ANON_KEY'));

        // Post record directly to Supabase REST API
        Http::withHeaders([
            'apikey'        => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation',
        ])->post(rtrim($supabaseUrl, '/') . '/rest/v1/treasury_transactions', $validated);

        return redirect()->route('financial')
            ->with('success', 'Treasury entry successfully recorded in Supabase!');
    }

    /**
     * Helper to fetch filtered transactions directly from Supabase PostgREST API without Eloquent.
     */
    private function fetchFromSupabaseApi(Request $request, string $url, string $key): Collection
    {
        $queryParams = [
            'select' => '*',
            'order'  => 'transaction_date.desc,created_at.desc',
        ];

        if ($request->filled('flow_type') && in_array($request->flow_type, ['INCOME', 'EXPENSE'])) {
            $queryParams['flow_type'] = 'eq.' . $request->flow_type;
        }

        if ($request->filled('category')) {
            $queryParams['category'] = 'eq.' . $request->category;
        }

        if ($request->filled('search')) {
            $term = urlencode(strtolower($request->search));
            $queryParams['or'] = "(title.ilike.*{$term}*,description.ilike.*{$term}*,payee_or_source.ilike.*{$term}*)";
        }

        $endpoint = rtrim($url, '/') . '/rest/v1/treasury_transactions';
        $response = Http::withHeaders([
            'apikey'        => $key,
            'Authorization' => 'Bearer ' . $key,
            'Accept'        => 'application/json',
        ])->get($endpoint, $queryParams);

        if ($response->successful()) {
            $categoryMeta = self::categoryMeta();
            
            // Map raw JSON objects to attach computed label and badge_class fields directly
            return collect($response->json())->map(function ($item) use ($categoryMeta) {
                $obj = (object) $item;
                $cat = $obj->category ?? '';
                $obj->category_label = $categoryMeta[$cat]['label'] ?? ucfirst($cat);
                $obj->badge_class = $categoryMeta[$cat]['badgeClass'] ?? 'tag-misc';
                return $obj;
            });
        }

        return collect();
    }

    /**
     * Fetch all transactions for summary computations without Eloquent.
     */
    private function fetchAllFromSupabaseApi(string $url, string $key): Collection
    {
        $endpoint = rtrim($url, '/') . '/rest/v1/treasury_transactions?select=*';

        $response = Http::withHeaders([
            'apikey'        => $key,
            'Authorization' => 'Bearer ' . $key,
            'Accept'        => 'application/json',
        ])->get($endpoint);

        if ($response->successful()) {
            return collect($response->json())->map(function ($item) {
                return (object) $item;
            });
        }

        return collect();
    }
}