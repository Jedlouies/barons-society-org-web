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
            <div class="alert-success">
                ✓ {{ session('success') }}
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


        <!-- 2. BREAKDOWN CARDS -->
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

        <!-- 3. LEDGER TABLE SECTION -->
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search donor, item, title..." onchange="this.form.submit()">
                </form>
            </div>

            <!-- Tab buttons preserving year & date inputs -->
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
                    
                    <a href="{{ route('financial', array_merge($filterParams, ['category' => 'burial'])) }}#ledger-section" 
                       class="tab-btn {{ request('category') === 'burial' ? 'active' : '' }}">Burial Aid</a>
                    
                    <a href="{{ route('financial', array_merge($filterParams, ['category' => 'school'])) }}#ledger-section" 
                       class="tab-btn {{ request('category') === 'school' ? 'active' : '' }}">School Donation</a>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="detailed-table" id="financialLedgerTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Flow Type</th>
                            <th>Category</th>
                            <th>Member / Payee / Source</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="ledgerTbody">
                        @forelse($transactions as $tx)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($tx->transaction_date)->format('M d, Y') }}</td>
                            <td><strong>{{ $tx->title }}</strong></td>
                            <td style="color:#64748b;">{{ $tx->description }}</td>
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px; color: #94a3b8;">
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
<div class="modal-backdrop" id="entryModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Record Supabase Treasury Entry</h3>
            <button class="close-modal-btn" onclick="closeTransactionModal()">&times;</button>
        </div>
        <form action="{{ route('financial.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Transaction Date</label>
                <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>Flow Type</label>
                <select name="flow_type" id="modalFlowType" onchange="updateModalCategories()" required>
                    <option value="INCOME">📥 Income (Fund In)</option>
                    <option value="EXPENSE">📤 Expense (Fund Out)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" id="modalCategory" required>
                </select>
            </div>

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" placeholder="e.g., RAATI Meal Expense" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="2" placeholder="e.g., Meals and snacks for 120 cadet inspectors" required></textarea>
            </div>

            <div class="form-group">
                <label>Amount (PHP ₱)</label>
                <input type="number" name="amount" step="0.01" placeholder="e.g. 25000.00" required>
            </div>

            <div class="form-group">
                <label>Payee / Member / Source</label>
                <input type="text" name="payee_or_source" placeholder="e.g. Catering Service Provider" required>
            </div>

            <button type="submit" class="modal-submit-btn">Save Financial Entry to Supabase</button>
        </form>
    </div>
</div>

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

function openTransactionModal() {
    document.getElementById('entryModal').classList.add('active');
    updateModalCategories();
}

function closeTransactionModal() {
    document.getElementById('entryModal').classList.remove('active');
}

function updateModalCategories() {
    const flowType = document.getElementById('modalFlowType').value;
    const catSelect = document.getElementById('modalCategory');
    catSelect.innerHTML = '';

    const list = (flowType === 'INCOME') ? incomeCategories : expenseCategories;
    list.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.code;
        option.textContent = cat.name;
        catSelect.appendChild(option);
    });
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
        if (breakdownElem) {
            breakdownElem.scrollIntoView({ behavior: 'smooth' });
        }
    } else if (window.location.hash === "#ledger-section" || searchParams.has('flow_type') || searchParams.has('category') || searchParams.has('search')) {
        const ledgerElem = document.getElementById("ledger-section");
        if (ledgerElem) {
            ledgerElem.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
</script>

</body>
</html>