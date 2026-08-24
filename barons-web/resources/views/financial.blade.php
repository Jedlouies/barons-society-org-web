<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Barons Society | Financial</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/BaronsLogo.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
/* Custom Dropdown Styling for Ledger Actions */
.dropdown-action-wrap {
    position: relative;
    display: inline-block;
}

.dropdown-action-btn {
    background: #ffffff;
    color: #2563eb;
    border: 1px solid #93c5fd;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.dropdown-action-btn:hover {
    background: #eff6ff;
}

.dropdown-action-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    margin-top: 4px;
    background: #ffffff;
    min-width: 140px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    z-index: 100;
    overflow: hidden;
}

.dropdown-action-wrap.active .dropdown-action-menu {
    display: block;
}

.dropdown-action-menu a {
    display: block;
    padding: 8px 12px;
    color: #0f172a;
    text-decoration: none;
    font-size: 12px;
    font-weight: 500;
    transition: background 0.15s ease;
}

.dropdown-action-menu a:hover {
    background: #f1f5f9;
    color: #2563eb;
}
</style>
</head>

<body>

<nav>
    <div class="nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/BaronsLogo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
            <span>Barons Society Incorporated</span>
        </a>

        <div class="nav-links">
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            <a href="{{ url('/blogs') }}">News & Updates</a>
            <a href="{{ url('/member-classes') }}">Classes</a>
            <a href="{{ url('/bylaws') }}">Bylaws</a>
            <a href="{{ route('financial') }}" class="active">Funds</a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-logout-btn">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container hero-header-flex">
        <div class="hero-content">
            <h1>Society Financial Dashboard</h1>
            <p>
                Real-time tracking of inflow funds (Monthly Dues, Donations, Gross Project Income, Fundraising & Merchandise) and outflow expenses (Weddings, Burials, Meetings, School Donations, Events, Projects & Misc).
            </p>
        </div>
    </div>
</section>

<section class="dashboard-section">
    <div class="container">

        @if(session('success'))
            <div class="alert-success" style="margin-bottom: 20px; background-color: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($errors->has('unauthorized'))
            <div class="alert-error" style="margin-bottom: 20px; background-color: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px;">
                ✕ {{ $errors->first('unauthorized') }}
            </div>
        @endif

        @php
            $posLower = strtolower($memberPosition ?? '');
            $isAuthorizedTreasuryUser = str_contains($posLower, 'treasurer') 
                                     || str_contains($posLower, 'auditor') 
                                     
        @endphp

        @if($isAuthorizedTreasuryUser)
            <div style="margin-bottom: 20px; display: flex; justify-content: flex-end;">
                <button type="button" class="modal-submit-btn" onclick="openTransactionModal()" style="width: auto; padding: 10px 20px; display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Record Entry</span>
                </button>
            </div>
        @endif

        <div class="filter-control-card" id="breakdown-section">
            <form action="{{ route('financial') }}#breakdown-section" method="GET" id="dateFilterForm">
                @foreach(request()->only(['flow_type', 'category', 'search']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; align-items: end;">
                    <div>
                        <label for="start_date_input" style="display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px;">Start Date</label>
                        <input type="date" name="start_date" id="start_date_input" value="{{ request('start_date') }}" 
                               style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; outline: none; background: #fff; color: #0f172a;">
                    </div>

                    <div>
                        <label for="end_date_input" style="display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px;">End Date</label>
                        <input type="date" name="end_date" id="end_date_input" value="{{ request('end_date') }}" 
                               style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; outline: none; background: #fff; color: #0f172a;">
                    </div>

                    <div>
                        <label for="breakdown_year_select" style="display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px;">Fiscal Year Preset</label>
                        <select name="year" id="breakdown_year_select" onchange="clearCustomDatesAndSubmit()" 
                                style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; outline: none; background: #fff; color: #0f172a; font-weight: 500; cursor: pointer;">
                            <option value="all" {{ !request('year') || request('year') === 'all' ? 'selected' : '' }}>All-Time Totals</option>
                            @php
                                $yearList = $availableYears ?? range(date('Y'), date('Y') - 5);
                            @endphp
                            @foreach($yearList as $yr)
                                <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>FY {{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <button type="submit" class="filter-btn-submit">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                            Apply Filter
                        </button>
                        <a href="{{ route('financial') }}" class="filter-btn-reset">Reset All</a>
                    </div>
                </div>
            </form>
        </div>
        
        <div style="margin-bottom: 15px; font-size: 14px; font-weight: 600; color: #475569;">
            Showing Records For: 
            <span style="color: #0f172a; font-weight: 700;">
                @if(request('start_date') && request('end_date'))
                    {{ \Carbon\Carbon::parse(request('start_date'))->format('M d, Y') }} - {{ \Carbon\Carbon::parse(request('end_date'))->format('M d, Y') }}
                @elseif(request('year') && request('year') !== 'all')
                    Fiscal Year {{ request('year') }}
                @else
                    All-Time Totals
                @endif
            </span>
        </div>

        <div class="overview-cards-grid">
            <div class="fin-summary-card highlight">
                <span class="card-title">Net Cash Available</span>
                <div class="card-amount">₱{{ number_format($netCash, 2) }}</div>
                <div class="card-sub">
                    <span>↑ Active Reserve (Period)</span>
                </div>
            </div>

            <div class="fin-summary-card">
                <span class="card-title">Total Funds Collected (Inflow)</span>
                <div class="card-amount" style="color:#16a34a;">₱{{ number_format($totalInflow, 2) }}</div>
                <div class="card-sub">
                    <span>Dues, Donations & Sales</span>
                </div>
            </div>

            <div class="fin-summary-card">
                <span class="card-title">Total Funds Spent (Outflow)</span>
                <div class="card-amount" style="color:#dc2626;">₱{{ number_format($totalOutflow, 2) }}</div>
                <div class="card-sub">
                    <span>Welfare, Events & Misc</span>
                </div>
            </div>

            <div class="fin-summary-card">
                <span class="card-title">Member Monthly Dues Collected</span>
                <div class="card-amount">₱{{ number_format($monthlyDuesTotal, 2) }}</div>
                <div class="card-sub">
                    <span>Active Alumni Contributions</span>
                </div>
            </div>
        </div>

        <!-- BREAKDOWN CARDS -->
        <div class="grid-two-columns">
            <div class="panel-card">
                <h3 class="income-header" style="display: flex; align-items: center;">
                    <span>Inflow Breakdown (Where Funds Come From)</span>
                </h3>
                
                @forelse($inflowBreakdown as $item)
                <div class="cat-progress-item">
                    <div class="cat-progress-label">
                        <span> {{ $item['label'] }}</span>
                        <span>₱{{ number_format($item['amount'], 0) }} ({{ $item['percentage'] }}%)</span>
                    </div>
                    <div class="cat-progress-track">
                        <div class="cat-progress-fill-income" style="width: {{ $item['percentage'] }}%"></div>
                    </div>
                </div>
                @empty
                <p style="font-size: 13px; color: #94a3b8; text-align: center; padding: 20px 0;">No inflow data found for this selected period.</p>
                @endforelse
            </div>

            <div class="panel-card">
                <h3 class="expense-header" style="display: flex; align-items: center;">
                    <span>Outflow Breakdown (Where Funds Go)</span>
                </h3>

                @forelse($outflowBreakdown as $item)
                <div class="cat-progress-item">
                    <div class="cat-progress-label">
                        <span> {{ $item['label'] }}</span>
                        <span>₱{{ number_format($item['amount'], 0) }} ({{ $item['percentage'] }}%)</span>
                    </div>
                    <div class="cat-progress-track">
                        <div class="cat-progress-fill-expense" style="width: {{ $item['percentage'] }}%"></div>
                    </div>
                </div>
                @empty
                <p style="font-size: 13px; color: #94a3b8; text-align: center; padding: 20px 0;">No outflow data found for this selected period.</p>
                @endforelse
            </div>
        </div>

        <!-- LEDGER TABLE SECTION -->
        <div class="project-panel" id="ledger-section">
            <div class="panel-header">
                <div class="panel-title-box">
                    <h3>Itemized Financial Ledger</h3>
                    <p>Live database records of all society income collections and disbursed expense transactions</p>
                </div>

                <form action="{{ route('financial') }}#ledger-section" method="GET" class="search-box-wrap">
                    @foreach(request()->only(['year', 'start_date', 'end_date', 'flow_type', 'category']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Ref No, donor, item, title..." onchange="this.form.submit()">
                </form>
            </div>

            @php
                $filterParams = request()->only(['year', 'start_date', 'end_date', 'search']);
            @endphp

            <div class="view-toggle-bar">
                <div class="category-tabs">
                    <a href="{{ route('financial', array_merge($filterParams, [])) }}#ledger-section" 
                       class="tab-btn {{ !request('flow_type') && !request('category') ? 'active' : '' }}">All Entries</a>
                    
                    <a href="{{ route('financial', array_merge($filterParams, ['flow_type' => 'INCOME'])) }}#ledger-section" 
                       class="tab-btn {{ request('flow_type') === 'INCOME' ? 'active' : '' }}">Funds In (Income)</a>
                    
                    <a href="{{ route('financial', array_merge($filterParams, ['flow_type' => 'EXPENSE'])) }}#ledger-section" 
                       class="tab-btn {{ request('flow_type') === 'EXPENSE' ? 'active' : '' }}">Funds Out (Expenses)</a>
                    
                    <a href="{{ route('financial', array_merge($filterParams, ['category' => 'dues'])) }}#ledger-section" 
                       class="tab-btn {{ request('category') === 'dues' ? 'active' : '' }}">Member Dues</a>
                    
                </div>
            </div>

            <div class="table-wrapper">
                <table class="detailed-table" id="financialLedgerTable">
                    <thead>
                        <tr>
                            <th>Ref No.</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Flow</th>
                            <th>Category</th>
                            <th>Member / Payee</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ledgerTbody">
                        @forelse($transactions as $tx)
                        @php
                            $isOwner = ($currentMemberId && isset($tx->member_id) && $tx->member_id === $currentMemberId) 
                                    || (strtolower(trim($tx->payee_or_source ?? '')) === strtolower(trim(auth()->user()->name ?? '')));
                            $images = !empty($tx->receipt_images) && is_array($tx->receipt_images) ? $tx->receipt_images : (!empty($tx->receipt_image) ? [$tx->receipt_image] : []);
                            
                            $canSeeReceipt = ($tx->flow_type === 'EXPENSE') || $isAuthorizedTreasuryUser || $isOwner;
                        @endphp
                        <tr>
                            <td><code style="font-size: 11px; background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">{{ $tx->reference_number ?? 'N/A' }}</code></td>
                            <td>{{ \Carbon\Carbon::parse($tx->transaction_date)->format('M d, Y') }}</td>
                            <td>
                                <strong>{{ $tx->title }}</strong>
                                @if(!empty($tx->invoice_number))
                                    <div style="font-size: 11px; color: #64748b;">Inv: {{ $tx->invoice_number }}</div>
                                @endif
                                @if(!empty($tx->items) && count((array)$tx->items) > 0)
                                    <div style="font-size: 11px; color: #475569; margin-top: 2px;">
                                        <em>Items: {{ implode(', ', array_column((array)$tx->items, 'name')) }}</em>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($tx->flow_type === 'INCOME')
                                    <strong style="color:#16a34a;">INFLOW</strong>
                                @else
                                    <strong style="color:#dc2626;">OUTFLOW</strong>
                                @endif
                            </td>
                            <td>
                                <span class="tag-badge {{ $tx->badge_class }}">
                                    {{ $tx->category_label }}
                                </span>
                            </td>
                            <td>{{ $tx->payee_or_source }}</td>
                            <td style="font-weight:700; color: {{ $tx->flow_type === 'INCOME' ? '#16a34a' : '#dc2626' }};">
                                {{ $tx->flow_type === 'INCOME' ? '+' : '-' }} ₱{{ number_format($tx->amount, 2) }}
                            </td>
                            <td>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    @if($canSeeReceipt)
                                        <a href="{{ route('financial.receipt.download', $tx->id) }}" target="_blank" title="Download Receipt" style="color: #0f172a; text-decoration: none; font-size: 12px; font-weight: 600; padding: 4px 8px; border: 1px solid #cbd5e1; border-radius: 4px; white-space: nowrap;">
                                            Receipt
                                        </a>
                                    @endif

                                    @if(count($images) === 1)
                                        <a href="{{ $images[0] }}" target="_blank" title="View Attachment" style="color: #2563eb; text-decoration: none; font-size: 12px; font-weight: 600; padding: 4px 8px; border: 1px solid #93c5fd; border-radius: 4px; white-space: nowrap;">
                                            File
                                        </a>
                                    @elseif(count($images) > 1)
                                        <div class="dropdown-action-wrap">
                                            <button type="button" class="dropdown-action-btn" onclick="toggleActionDropdown(this, event)">
                                                <span>Files</span>
                                                <small style="font-size: 9px;">▼</small>
                                            </button>
                                            <div class="dropdown-action-menu">
                                                @foreach($images as $idx => $imgUrl)
                                                    <a href="{{ $imgUrl }}" target="_blank">
                                                        📄 Attachment #{{ $idx + 1 }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 30px; color: #94a3b8;">
                                No financial transactions found for the selected period.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<!-- MODAL ENTRY FORM -->
@if($isAuthorizedTreasuryUser)
<div class="modal-backdrop" id="entryModal">
    <div class="modal-box" style="max-height: 90vh; overflow-y: auto; position: relative;">
        <div class="modal-header">
            <h3>Record Treasury Entry</h3>
            <button type="button" class="close-modal-btn" onclick="closeTransactionModal()">&times;</button>
        </div>

        <form id="treasuryEntryForm" action="{{ route('financial.store') }}" method="POST" enctype="multipart/form-data" onsubmit="submitTreasuryForm(event)">
            @csrf
            
            <div class="form-group">
                <label>Transaction Date *</label>
                <input type="date" name="transaction_date" id="tx_date" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>Flow Type *</label>
                <select name="flow_type" id="modalFlowType" onchange="updateModalCategories()" required>
                    <option value="INCOME">Income (Fund In)</option>
                    <option value="EXPENSE">Expense (Fund Out)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Category *</label>
                <select name="category" id="modalCategory" onchange="toggleCategoryFields()" required></select>
            </div>

            <!-- Searchable Member Selection for Dues & Donations -->
            <div class="form-group" id="memberSelectContainer" style="display: none;">
                <label for="memberFilterInput">Select Member *</label>
                <input type="text" id="memberFilterInput" placeholder="Type to search member..." onkeyup="filterMemberList()" style="margin-bottom: 6px;">
                <select name="member_id" id="modalMemberSelect" onchange="syncMemberPayeeName()">
                    <option value="">-- Choose Member --</option>
                    @foreach($members as $mb)
                        <option value="{{ $mb['id'] }}" data-name="{{ trim(($mb['first_name'] ?? '') . ' ' . ($mb['last_name'] ?? '')) }}">
                            {{ $mb['first_name'] }} {{ $mb['last_name'] }} ({{ $mb['email'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Title *</label>
                <input type="text" name="title" id="tx_title" placeholder="e.g., Paceno Wedding Assistance" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="tx_description" rows="2" placeholder="e.g., Overview of assistance provided"></textarea>
            </div>

            <!-- Dynamic Itemized Breakdown Section -->
            <div style="margin-top: 15px; border-top: 1px solid #e2e8f0; padding-top: 12px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <label id="itemizedSectionLabel" style="font-weight: 600; font-size: 13px; color: #0f172a;">Itemized Expenses (Optional)</label>
                    <button type="button" onclick="addItemRow()" style="background: #0f172a; color: #fff; border: none; border-radius: 4px; padding: 4px 10px; font-size: 12px; cursor: pointer;">+ Add Item</button>
                </div>

                <div id="itemRowsContainer">
                    <div class="item-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                        <input type="text" name="item_names[]" placeholder="Item Name (e.g. Snacks, Chairs)" style="flex: 2; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px;">
                        <input type="number" name="item_amounts[]" step="0.01" placeholder="Amount (₱)" class="item-amount-input" oninput="calculateItemsTotal()" style="flex: 1; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px;">
                        <button type="button" onclick="removeItemRow(this)" style="background: #ef4444; color: #fff; border: none; border-radius: 6px; padding: 0 10px; cursor: pointer;">✕</button>
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-top: 10px;">
                <label>Total Amount (PHP ₱) *</label>
                <input type="number" name="amount" id="tx_amount" step="0.01" placeholder="e.g. 25000.00" required>
                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">Calculated automatically if item amounts are filled in above.</small>
            </div>

            <div class="form-group">
                <label id="payeeLabel">Payee / Member / Source *</label>
                <input type="text" name="payee_or_source" id="tx_payee" placeholder="e.g. Juan Dela Cruz" required>
            </div>

            <!-- Expense Specific Fields -->
            <div id="expenseFieldsContainer" style="display: none; border-top: 1px solid #e2e8f0; padding-top: 12px; margin-top: 12px;">
                <div class="form-group">
                    <label>Invoice Number</label>
                    <input type="text" name="invoice_number" id="tx_invoice" placeholder="e.g. INV-2026-0091">
                </div>

                <div class="form-group">
                    <label>Upload Receipt Images (Multiple Allowed)</label>
                    <input type="file" name="receipt_image_file[]" id="tx_receipt_file" accept="image/jpeg,image/png,image/webp" multiple>
                </div>
            </div>

            <button type="submit" id="saveEntryBtn" class="modal-submit-btn" style="margin-top: 15px;">
                <span id="saveBtnText">Save Financial Entry</span>
            </button>

            <div id="modalAlertSuccess" class="alert-success" style="display: none; margin-top: 16px; background-color: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; font-weight: 500;"></div>
            <div id="modalAlertError" class="alert-error" style="display: none; margin-top: 16px; background-color: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; font-weight: 500;"></div>

        </form>
    </div>
</div>
@endif

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="{{ asset('images/BaronsLogo.png') }}" alt="" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
                    <h3>Barons Society<br>ROTC Alumni Incorporated</h3>
                </div>
                <p>
                    Building Brotherhood, Leadership, and Service through unity, patriotism, and community engagement. Honoring our legacy while inspiring future generations.
                </p>
            </div>

            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>📍 Cagayan de Oro City, Philippines</p>
                <p>📧 info@baronssociety.org</p>
                <p>📞 +63 912 345 6789</p>
            </div>
        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} Barons Society ROTC Alumni Incorporated. SEC No. 2022080064500-05. All Rights Reserved.
        </div>
    </div>
</footer>

<script>
const incomeCategories = [
    { code: 'dues', name: 'Monthly Dues' },
    { code: 'donation', name: 'Donations' },
    { code: 'project-inc', name: 'Gross Income from Projects' },
    { code: 'fundraising', name: 'Fund Raising' },
    { code: 'merch', name: 'Merchandise Sales' }
];

const expenseCategories = [
    { code: 'wedding', name: 'Wedding Assistance' },
    { code: 'burial', name: 'Burial Aid' },
    { code: 'meeting', name: 'Meetings & Admin' },
    { code: 'school', name: 'Donate to School' },
    { code: 'event', name: 'Events' },
    { code: 'project-exp', name: 'Projects Expense' },
    { code: 'misc', name: 'Miscellaneous' }
];

function toggleActionDropdown(btn, event) {
    event.stopPropagation();
    const wrap = btn.closest('.dropdown-action-wrap');
    document.querySelectorAll('.dropdown-action-wrap').forEach(el => {
        if (el !== wrap) el.classList.remove('active');
    });
    wrap.classList.toggle('active');
}

document.addEventListener('click', function() {
    document.querySelectorAll('.dropdown-action-wrap').forEach(el => el.classList.remove('active'));
});

function addItemRow() {
    const container = document.getElementById('itemRowsContainer');
    const row = document.createElement('div');
    row.className = 'item-row';
    row.style = 'display: flex; gap: 8px; margin-bottom: 8px;';
    row.innerHTML = `
        <input type="text" name="item_names[]" placeholder="Item Name" style="flex: 2; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px;">
        <input type="number" name="item_amounts[]" step="0.01" placeholder="Amount (₱)" class="item-amount-input" oninput="calculateItemsTotal()" style="flex: 1; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px;">
        <button type="button" onclick="removeItemRow(this)" style="background: #ef4444; color: #fff; border: none; border-radius: 6px; padding: 0 10px; cursor: pointer;">✕</button>
    `;
    container.appendChild(row);
}

function removeItemRow(btn) {
    const row = btn.parentElement;
    row.remove();
    calculateItemsTotal();
}

function calculateItemsTotal() {
    const amountInputs = document.querySelectorAll('.item-amount-input');
    let total = 0;
    amountInputs.forEach(input => {
        const val = parseFloat(input.value);
        if (!isNaN(val) && val > 0) {
            total += val;
        }
    });

    if (total > 0) {
        const mainAmountInput = document.getElementById('tx_amount');
        mainAmountInput.value = total.toFixed(2);
    }
}

function openTransactionModal() {
    const modal = document.getElementById('entryModal');
    if (modal) {
        modal.classList.add('active');
        updateModalCategories();
        hideAlerts();
    }
}

function closeTransactionModal() {
    const modal = document.getElementById('entryModal');
    if (modal) {
        modal.classList.remove('active');
        hideAlerts();
    }
}

function hideAlerts() {
    const successAlert = document.getElementById('modalAlertSuccess');
    const errorAlert = document.getElementById('modalAlertError');
    if (successAlert) successAlert.style.display = 'none';
    if (errorAlert) errorAlert.style.display = 'none';
}

function updateModalCategories() {
    const flowTypeElem = document.getElementById('modalFlowType');
    const catSelect = document.getElementById('modalCategory');
    const itemLabel = document.getElementById('itemizedSectionLabel');
    if (!flowTypeElem || !catSelect) return;

    const flowType = flowTypeElem.value;
    catSelect.innerHTML = '';

    if (itemLabel) {
        itemLabel.textContent = (flowType === 'INCOME') ? 'Itemized Income Breakdown (Optional)' : 'Itemized Expenses (Optional)';
    }

    const list = (flowType === 'INCOME') ? incomeCategories : expenseCategories;
    list.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.code;
        option.textContent = cat.name;
        catSelect.appendChild(option);
    });

    toggleCategoryFields();
}

function toggleCategoryFields() {
    const flowType = document.getElementById('modalFlowType').value;
    const cat = document.getElementById('modalCategory').value;
    const memberContainer = document.getElementById('memberSelectContainer');
    const expenseContainer = document.getElementById('expenseFieldsContainer');

    if (flowType === 'INCOME' && (cat === 'dues' || cat === 'donation')) {
        memberContainer.style.display = 'block';
    } else {
        memberContainer.style.display = 'none';
    }

    if (flowType === 'EXPENSE') {
        expenseContainer.style.display = 'block';
    } else {
        expenseContainer.style.display = 'none';
    }
}

function filterMemberList() {
    const input = document.getElementById('memberFilterInput').value.toLowerCase();
    const select = document.getElementById('modalMemberSelect');
    const options = select.getElementsByTagName('option');

    for (let i = 1; i < options.length; i++) {
        const txt = options[i].textContent.toLowerCase();
        options[i].style.display = txt.includes(input) ? '' : 'none';
    }
}

function syncMemberPayeeName() {
    const select = document.getElementById('modalMemberSelect');
    const selectedOpt = select.options[select.selectedIndex];
    const memberName = selectedOpt.getAttribute('data-name');
    if (memberName) {
        document.getElementById('tx_payee').value = memberName;
    }
}

async function submitTreasuryForm(event) {
    event.preventDefault();
    hideAlerts();

    const form = event.target;
    const saveBtn = document.getElementById('saveEntryBtn');
    const btnText = document.getElementById('saveBtnText');
    const successAlert = document.getElementById('modalAlertSuccess');
    const errorAlert = document.getElementById('modalAlertError');

    if (saveBtn) saveBtn.disabled = true;
    if (btnText) btnText.textContent = 'Saving Record...';

    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (response.ok && data.success) {
            if (successAlert) {
                successAlert.textContent = '✓ ' + data.message;
                successAlert.style.display = 'block';
            }

            // Reset form fields
            document.getElementById('tx_title').value = '';
            document.getElementById('tx_description').value = '';
            document.getElementById('tx_amount').value = '';
            document.getElementById('tx_payee').value = '';
            document.getElementById('tx_invoice').value = '';
            document.getElementById('tx_receipt_file').value = '';
            document.getElementById('modalMemberSelect').selectedIndex = 0;

            // Reset dynamic item rows to single initial row
            const itemContainer = document.getElementById('itemRowsContainer');
            if (itemContainer) {
                itemContainer.innerHTML = `
                    <div class="item-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                        <input type="text" name="item_names[]" placeholder="Item Name (e.g. Snacks, Chairs)" style="flex: 2; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px;">
                        <input type="number" name="item_amounts[]" step="0.01" placeholder="Amount (₱)" class="item-amount-input" oninput="calculateItemsTotal()" style="flex: 1; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px;">
                        <button type="button" onclick="removeItemRow(this)" style="background: #ef4444; color: #fff; border: none; border-radius: 6px; padding: 0 10px; cursor: pointer;">✕</button>
                    </div>
                `;
            }

            const modalBox = document.querySelector('#entryModal .modal-box');
            if (modalBox) modalBox.scrollTop = 0;

        } else {
            if (errorAlert) {
                errorAlert.textContent = '✕ ' + (data.message || 'Failed to save entry.');
                errorAlert.style.display = 'block';
            }
        }
    } catch (err) {
        if (errorAlert) {
            errorAlert.textContent = '✕ Error saving entry: ' + err.message;
            errorAlert.style.display = 'block';
        }
    } finally {
        if (saveBtn) saveBtn.disabled = false;
        if (btnText) btnText.textContent = 'Save Financial Entry';
    }
}

function clearCustomDatesAndSubmit() {
    document.getElementById('start_date_input').value = '';
    document.getElementById('end_date_input').value = '';
    document.getElementById('dateFilterForm').submit();
}

document.addEventListener("DOMContentLoaded", function() {
    const searchParams = new URLSearchParams(window.location.search);
    if (window.location.hash === "#breakdown-section" || searchParams.has('year') || searchParams.has('start_date') || searchParams.has('end_date')) {
        const breakdownElem = document.getElementById("breakdown-section");
        if (breakdownElem) breakdownElem.scrollIntoView({ behavior: 'smooth' });
    } else if (window.location.hash === "#ledger-section" || searchParams.has('flow_type') || searchParams.has('category') || searchParams.has('search')) {
        const ledgerElem = document.getElementById("ledger-section");
        if (ledgerElem) ledgerElem.scrollIntoView({ behavior: 'smooth' });
    }
});
</script>

</body>
</html>