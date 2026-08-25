<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FinancialController extends Controller
{
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

    public function index(Request $request)
    {
        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY', env('SUPABASE_ANON_KEY'));

        // Retrieve position and member details from active session
        $memberPosition  = Session::get('member_position', 'Member');
        $memberDetails   = Session::get('member_details', []);
        $currentMemberId = $memberDetails['id'] ?? null;

        // Fetch members list for dropdown
        $members = collect();
        if ($supabaseUrl && $supabaseKey) {
            try {
                $mResp = Http::withoutVerifying()->withHeaders([
                    'apikey'        => $supabaseKey,
                    'Authorization' => 'Bearer ' . $supabaseKey,
                ])->get(rtrim($supabaseUrl, '/') . "/rest/v1/members", [
                    'select' => 'id,first_name,last_name,nickname,email',
                    'order'  => 'first_name.asc',
                ]);

                if ($mResp->successful()) {
                    $members = collect($mResp->json());
                }
            } catch (\Exception $e) {}
        }

        $allRawTransactions = $this->fetchAllFromSupabaseApi($supabaseUrl, $supabaseKey);

        $availableYears = $allRawTransactions->map(function ($item) {
            return !empty($item->transaction_date) ? Carbon::parse($item->transaction_date)->format('Y') : null;
        })->filter()->unique()->sortDesc()->values()->all();

        if (empty($availableYears)) {
            $availableYears = range(date('Y'), date('Y') - 5);
        }

        $filteredBaseTransactions = $allRawTransactions->filter(function ($item) use ($request) {
            if (empty($item->transaction_date)) return true;

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

        $totalInflow = $filteredBaseTransactions->where('flow_type', 'INCOME')->sum('amount');
        $totalOutflow = $filteredBaseTransactions->where('flow_type', 'EXPENSE')->sum('amount');
        $netCash = $totalInflow - $totalOutflow;
        $monthlyDuesTotal = $filteredBaseTransactions->where('flow_type', 'INCOME')
            ->where('category', 'dues')
            ->sum('amount');

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
            'availableYears',
            'memberPosition',
            'members',
            'currentMemberId'
        ));
    }

    public function store(Request $request)
    {
        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY', env('SUPABASE_ANON_KEY'));

        $position = Session::get('member_position', '');
        $posLower = strtolower($position);

        $isAuthorized = str_contains($posLower, 'treasurer') 
                     || str_contains($posLower, 'auditor') 
                     || str_contains($posLower, 'admin');

        if (!$isAuthorized) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized position.'], 403);
            }
            return redirect()->route('financial')->withErrors(['unauthorized' => 'Unauthorized action.']);
        }

        $validated = $request->validate([
            'title'                => 'required|string|max:255',
            'description'          => 'nullable|string',
            'flow_type'            => 'required|in:INCOME,EXPENSE',
            'category'             => 'required|string|max:50',
            'amount'               => 'nullable|numeric|min:0.01',
            'payee_or_source'      => 'required|string|max:255',
            'transaction_date'     => 'required|date',
            'member_id'            => 'nullable|uuid',
            'invoice_number'       => 'nullable|string|max:100',
            'receipt_image_file'   => 'nullable|array',
            'receipt_image_file.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'item_names'           => 'nullable|array',
            'item_names.*'         => 'nullable|string|max:255',
            'item_amounts'         => 'nullable|array',
            'item_amounts.*'       => 'nullable|numeric|min:0',
        ]);

        $itemsList = [];
        $calculatedTotal = 0;

        if (!empty($validated['item_names']) && !empty($validated['item_amounts'])) {
            foreach ($validated['item_names'] as $index => $itemName) {
                $itemAmt = floatval($validated['item_amounts'][$index] ?? 0);
                if (!empty(trim($itemName)) && $itemAmt > 0) {
                    $itemsList[] = [
                        'name'   => trim($itemName),
                        'amount' => $itemAmt,
                    ];
                    $calculatedTotal += $itemAmt;
                }
            }
        }

        $finalAmount = ($calculatedTotal > 0) ? $calculatedTotal : floatval($validated['amount'] ?? 0);

        if ($finalAmount <= 0) {
            return response()->json(['success' => false, 'message' => 'Total amount must be greater than 0.'], 422);
        }

        $refNum = 'BS-' . Carbon::parse($validated['transaction_date'])->format('Ymd') . '-' . strtoupper(Str::random(4));
        $validated['reference_number'] = $refNum;
        
        $sessionUser = Session::get('supabase_user', []);
        $validated['recorded_by'] = $sessionUser['user_metadata']['name'] ?? $sessionUser['email'] ?? ($position ?: 'Treasury Officer');

        $receiptImageUrls = [];
        if ($request->hasFile('receipt_image_file')) {
            foreach ($request->file('receipt_image_file') as $file) {
                try {
                    $ext       = $file->getClientOriginalExtension() ?: 'jpg';
                    $fileName  = 'receipts/' . time() . '_' . Str::random(8) . '.' . $ext;
                    $uploadUrl = rtrim($supabaseUrl, '/') . "/storage/v1/object/barons-images/{$fileName}";

                    $uploadResponse = Http::withoutVerifying()->withHeaders([
                        'apikey'        => $supabaseKey,
                        'Authorization' => 'Bearer ' . $supabaseKey,
                        'Content-Type'  => $file->getMimeType() ?: 'image/jpeg',
                        'x-upsert'      => 'true',
                    ])->withBody(file_get_contents($file->getRealPath()), $file->getMimeType() ?: 'image/jpeg')
                      ->post($uploadUrl);

                    if ($uploadResponse->successful()) {
                        $receiptImageUrls[] = rtrim($supabaseUrl, '/') . "/storage/v1/object/public/barons-images/{$fileName}";
                    }
                } catch (\Exception $e) {}
            }
        }

        $payload = [
            'reference_number' => $validated['reference_number'],
            'title'            => $validated['title'],
            'description'      => $validated['description'] ?? null,
            'flow_type'        => $validated['flow_type'],
            'category'         => $validated['category'],
            'amount'           => $finalAmount,
            'payee_or_source'  => $validated['payee_or_source'],
            'transaction_date' => $validated['transaction_date'],
            'recorded_by'      => $validated['recorded_by'],
            'member_id'        => !empty($validated['member_id']) ? $validated['member_id'] : null,
            'invoice_number'   => !empty($validated['invoice_number']) ? $validated['invoice_number'] : null,
            'receipt_image'    => $receiptImageUrls[0] ?? null,
            'receipt_images'   => $receiptImageUrls,
            'items'            => $itemsList,
        ];

        $response = Http::withoutVerifying()->withHeaders([
            'apikey'        => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation',
        ])->post(rtrim($supabaseUrl, '/') . '/rest/v1/treasury_transactions', $payload);

        if ($response->successful()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Treasury entry saved! Ref No: {$refNum}",
                    'reference_number' => $refNum,
                ]);
            }
            return redirect()->route('financial')->with('success', "Entry recorded! Ref No: {$refNum}");
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => false, 'message' => 'Failed to save entry.'], 500);
        }

        return redirect()->back()->withErrors(['unauthorized' => 'Failed to store entry.']);
    }

    public function downloadReceipt($id)
    {
        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY', env('SUPABASE_ANON_KEY'));

        if (!Session::has('supabase_access_token')) {
            return abort(401, 'Unauthorized');
        }

        $position = Session::get('member_position', '');
        $memberDetails = Session::get('member_details', []);
        $currentMemberId = $memberDetails['id'] ?? null;
        $sessionUser = Session::get('supabase_user', []);

        $response = Http::withoutVerifying()->withHeaders([
            'apikey'        => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
        ])->get(rtrim($supabaseUrl, '/') . "/rest/v1/treasury_transactions", [
            'select' => '*',
            'id'     => 'eq.' . $id,
            'limit'  => 1,
        ]);

        if (!$response->successful() || empty($response->json())) {
            return abort(404, 'Receipt not found');
        }

        $tx = (object) $response->json()[0];

        $posLower = strtolower($position);
        $isTreasuryOfficer = str_contains($posLower, 'treasurer') 
                          || str_contains($posLower, 'auditor')
                          || str_contains($posLower, 'admin');

        $isOwner = ($currentMemberId && isset($tx->member_id) && $tx->member_id === $currentMemberId) 
                || (strtolower(trim($tx->payee_or_source ?? '')) === strtolower(trim($sessionUser['email'] ?? '')));

        $canAccessReceipt = ($tx->flow_type === 'EXPENSE') || $isTreasuryOfficer || $isOwner;

        if (!$canAccessReceipt) {
            return abort(403, 'Unauthorized access.');
        }

        $orgLogo = asset('images/BaronsLogo.png'); 
        $orgAddress = "Cagayan de Oro City, Misamis Oriental, 9000";
        $treasurerName = "LUCRESIA"; 
        $treasurerTitle = "BARONS Society Treasurer";
        $signatureUrl = asset('images/signature.png'); 

        $itemsTableHtml = "";
        if (!empty($tx->items) && is_array($tx->items) && count($tx->items) > 0) {
            $itemSectionTitle = ($tx->flow_type === 'INCOME') ? 'Itemized Income Breakdown' : 'Itemized Expense Breakdown';
            $itemsTableHtml = "
            <div style='margin-top: 25px;'>
                <div class='label' style='margin-bottom: 8px;'>{$itemSectionTitle}</div>
                <table style='width: 100%; border-collapse: collapse; font-size: 13px;'>
                    <thead>
                        <tr style='background: #f1f5f9; text-align: left;'>
                            <th style='padding: 8px 12px; border: 1px solid #cbd5e1;'>Item Description</th>
                            <th style='padding: 8px 12px; border: 1px solid #cbd5e1; text-align: right;'>Amount</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($tx->items as $item) {
                $itemObj = (object)$item;
                $itemsTableHtml .= "
                        <tr>
                            <td style='padding: 8px 12px; border: 1px solid #e2e8f0;'>{$itemObj->name}</td>
                            <td style='padding: 8px 12px; border: 1px solid #e2e8f0; text-align: right; font-weight: 600;'>₱" . number_format($itemObj->amount, 2) . "</td>
                        </tr>";
            }
            $itemsTableHtml .= "
                    </tbody>
                </table>
            </div>";
        }

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <title>Receipt - {$tx->reference_number}</title>
            <style>
                body { font-family: 'Helvetica', 'Arial', sans-serif; padding: 40px; color: #0f172a; background: #f8fafc; }
                .receipt-card { 
                    border: 2px solid #0f172a; 
                    padding: 35px; 
                    border-radius: 12px; 
                    max-width: 650px; 
                    margin: 0 auto; 
                    background: #ffffff;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                }
                .header { 
                    display: flex; 
                    align-items: center; 
                    gap: 20px; 
                    border-bottom: 2px solid #e2e8f0; 
                    padding-bottom: 20px; 
                }
                .header-logo { width: 75px; height: 75px; object-fit: contain; }
                .header-info { flex: 1; }
                .header-info h2 { margin: 0; font-size: 20px; color: #0f172a; letter-spacing: 0.5px; }
                .header-info .sub-title { margin: 3px 0 0 0; color: #475569; font-weight: 600; font-size: 13px; text-transform: uppercase; }
                .header-info .address { margin: 5px 0 0 0; color: #64748b; font-size: 11px; line-height: 1.4; }

                .details-grid { margin-top: 25px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
                .label { font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; }
                .value { font-size: 14px; color: #0f172a; font-weight: 600; margin-top: 4px; }

                .amount-box { 
                    text-align: center; 
                    margin-top: 25px; 
                    background: #f8fafc; 
                    padding: 18px; 
                    border-radius: 8px; 
                    border: 1px dashed #cbd5e1; 
                }
                .amount { font-size: 28px; font-weight: 800; color: " . ($tx->flow_type === 'INCOME' ? '#16a34a' : '#dc2626') . "; margin-top: 4px; }

                .signature-section { 
                    margin-top: 35px; 
                    display: flex; 
                    justify-content: flex-end; 
                }
                .signature-block { width: 220px; text-align: center; }
                .signature-img-container { height: 50px; display: flex; align-items: flex-end; justify-content: center; }
                .signature-img { max-height: 50px; width: auto; object-fit: contain; }
                .signature-line { border-top: 1px solid #0f172a; margin-top: 5px; padding-top: 5px; }
                .signatory-name { font-weight: bold; font-size: 13px; color: #0f172a; text-transform: uppercase; }
                .signatory-title { font-size: 11px; color: #64748b; margin-top: 2px; }

                .footer { margin-top: 30px; text-align: center; font-size: 11px; color: #94a3b8; border-top: 1px solid #f1f5f9; padding-top: 15px; }
            </style>
        </head>
        <body>
            <div class='receipt-card'>
                <div class='header'>
                    <img src='{$orgLogo}' alt='Logo' class='header-logo' onerror=\"this.style.display='none'\">
                    <div class='header-info'>
                        <h2>BARONS SOCIETY INCORPORATED</h2>
                        <div class='sub-title'>Official Transaction Receipt</div>
                        <div class='address'>{$orgAddress}</div>
                    </div>
                </div>

                <div class='details-grid'>
                    <div>
                        <div class='label'>Reference Number</div>
                        <div class='value'>" . ($tx->reference_number ?? 'N/A') . "</div>
                    </div>
                    <div>
                        <div class='label'>Transaction Date</div>
                        <div class='value'>" . Carbon::parse($tx->transaction_date)->format('M d, Y') . "</div>
                    </div>
                    <div>
                        <div class='label'>Title</div>
                        <div class='value'>{$tx->title}</div>
                    </div>
                    <div>
                        <div class='label'>Category</div>
                        <div class='value'>" . ucfirst($tx->category) . "</div>
                    </div>
                    <div>
                        <div class='label'>" . ($tx->flow_type === 'INCOME' ? 'Received From' : 'Paid To') . "</div>
                        <div class='value'>{$tx->payee_or_source}</div>
                    </div>
                    <div>
                        <div class='label'>Invoice Number</div>
                        <div class='value'>" . ($tx->invoice_number ?? 'N/A') . "</div>
                    </div>
                </div>

                {$itemsTableHtml}

                <div class='amount-box'>
                    <div class='label'>Total Amount</div>
                    <div class='amount'>₱" . number_format($tx->amount, 2) . "</div>
                </div>

                <div class='signature-section'>
                    <div class='signature-block'>
                        <div class='signature-img-container'>
                            <img src='{$signatureUrl}' alt='Signature' class='signature-img' onerror=\"this.style.visibility='hidden'\">
                        </div>
                        <div class='signature-line'>
                            <div class='signatory-name'>{$treasurerName}</div>
                            <div class='signatory-title'>{$treasurerTitle}</div>
                        </div>
                    </div>
                </div>

                <div class='footer'>
                    Recorded By: " . ($tx->recorded_by ?? 'Treasury') . " | Printed on " . date('Y-m-d H:i') . "
                </div>
            </div>
        </body>
        </html>";

        return response($html)->header('Content-Type', 'text/html');
    }

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

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $queryParams['transaction_date'] = 'gte.' . $request->start_date;
            $queryParams['and'] = '(transaction_date.lte.' . $request->end_date . ')';
        } elseif ($request->filled('year') && $request->year !== 'all') {
            $queryParams['transaction_date'] = 'gte.' . $request->year . '-01-01';
            $queryParams['and'] = '(transaction_date.lte.' . $request->year . '-12-31)';
        }

        if ($request->filled('search')) {
            $term = urlencode(strtolower($request->search));
            $queryParams['or'] = "(title.ilike.*{$term}*,description.ilike.*{$term}*,payee_or_source.ilike.*{$term}*,reference_number.ilike.*{$term}*)";
        }

        $endpoint = rtrim($url, '/') . '/rest/v1/treasury_transactions';
        
        $response = Http::withoutVerifying()->withHeaders([
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

        $response = Http::withoutVerifying()->withHeaders([
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