<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class FinancialController extends Controller
{
    /**
     * Category metadata dictionary.
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
     * Display the financial dashboard by fetching directly from Supabase REST API.
     */
    public function index(Request $request)
    {
        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY', env('SUPABASE_ANON_KEY'));

        // 1. Fetch all raw entries for building available years list
        $allRawTransactions = $this->fetchAllFromSupabaseApi($supabaseUrl, $supabaseKey);

        // Calculate available years dynamically from database records
        $availableYears = $allRawTransactions->map(function ($item) {
            return !empty($item->transaction_date) ? Carbon::parse($item->transaction_date)->format('Y') : null;
        })->filter()->unique()->sortDesc()->values()->all();

        if (empty($availableYears)) {
            $availableYears = range(date('Y'), date('Y') - 5);
        }

        // 2. Filter dataset across stat-cards, breakdown, and ledger table
        $filteredBaseTransactions = $allRawTransactions->filter(function ($item) use ($request) {
            if (empty($item->transaction_date)) {
                return true;
            }

            $txDate = Carbon::parse($item->transaction_date)->format('Y-m-d');
            $txYear = Carbon::parse($item->transaction_date)->format('Y');

            if ($request->filled('start_date') && $request->filled('end_date')) {
                return $txDate >= $request->start_date && $txDate <= $request->end_date;
            }

            if ($request->filled('year') && $request->year !== 'all') {
                return $txYear == $request->year;
            }

            return true;
        });

        // 3. Stat Cards - Calculated from selected year/date period
        $totalInflow = $filteredBaseTransactions->where('flow_type', 'INCOME')->sum('amount');
        $totalOutflow = $filteredBaseTransactions->where('flow_type', 'EXPENSE')->sum('amount');
        $netCash = $totalInflow - $totalOutflow;
        $monthlyDuesTotal = $filteredBaseTransactions->where('flow_type', 'INCOME')
            ->where('category', 'dues')
            ->sum('amount');

        // 4. Inflow / Outflow Breakdown
        $inflowCategories = ['dues', 'donation', 'project-inc', 'fundraising', 'merch'];
        $outflowCategories = ['burial', 'school', 'project-exp', 'event', 'wedding', 'meeting', 'misc'];
        $categoryMeta = self::categoryMeta();

        $inflowBreakdown = [];
        foreach ($inflowCategories as $catKey) {
            $amount = $filteredBaseTransactions->where('flow_type', 'INCOME')
                ->where('category', $catKey)
                ->sum('amount');
            
            $percentage = $totalInflow > 0 ? round(($amount / $totalInflow) * 100, 1) : 0;
            
            $inflowBreakdown[] = [
                'key'        => $catKey,
                'label'      => $categoryMeta[$catKey]['label'] ?? $catKey,
                'icon'       => $categoryMeta[$catKey]['icon'] ?? '💰',
                'amount'     => $amount,
                'percentage' => $percentage,
            ];
        }

        $outflowBreakdown = [];
        foreach ($outflowCategories as $catKey) {
            $amount = $filteredBaseTransactions->where('flow_type', 'EXPENSE')
                ->where('category', $catKey)
                ->sum('amount');

            $percentage = $totalOutflow > 0 ? round(($amount / $totalOutflow) * 100, 1) : 0;

            $outflowBreakdown[] = [
                'key'        => $catKey,
                'label'      => $categoryMeta[$catKey]['label'] ?? $catKey,
                'icon'       => $categoryMeta[$catKey]['icon'] ?? '💸',
                'amount'     => $amount,
                'percentage' => $percentage,
            ];
        }

        // 5. Fetch filtered Ledger Table transactions from Supabase REST API
        $transactions = $this->fetchFromSupabaseApi($request, $supabaseUrl, $supabaseKey);

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
     * Store new entry in Supabase via REST API.
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

        Http::withHeaders([
            'apikey'        => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation',
        ])->post(rtrim($supabaseUrl, '/') . '/rest/v1/treasury_transactions', $validated);

        return redirect()->route('financial')
            ->with('success', 'Treasury entry successfully recorded in Supabase!');
    }

    private function fetchFromSupabaseApi(Request $request, string $url, string $key): Collection
    {
        $queryParams = [
            'select' => '*',
            'order'  => 'transaction_date.desc,created_at.desc',
        ];

        // Filter by flow type
        if ($request->filled('flow_type') && in_array($request->flow_type, ['INCOME', 'EXPENSE'])) {
            $queryParams['flow_type'] = 'eq.' . $request->flow_type;
        }

        // Filter by category
        if ($request->filled('category')) {
            $queryParams['category'] = 'eq.' . $request->category;
        }

        // Apply Date Range / Year filters directly to Supabase API call
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $queryParams['transaction_date'] = 'gte.' . $request->start_date;
            $queryParams['and'] = '(transaction_date.lte.' . $request->end_date . ')';
        } elseif ($request->filled('year') && $request->year !== 'all') {
            $startOfYear = $request->year . '-01-01';
            $endOfYear = $request->year . '-12-31';
            $queryParams['transaction_date'] = 'gte.' . $startOfYear;
            $queryParams['and'] = '(transaction_date.lte.' . $endOfYear . ')';
        }

        // Search term filter
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