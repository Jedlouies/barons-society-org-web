
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Barons Society | Financial</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/Barons Logo.png') }}" type="image/png">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f5f7;
    color:#222;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    justify-space:between;
}

.container{
    width:92%;
    max-width:1280px;
    margin:auto;
}

/* ================= NAVBAR ================= */

nav{
    background:#111;
    padding:20px 0;
    position:sticky;
    top:0;
    z-index:1000;
    box-shadow:0 4px 15px rgba(0,0,0,.15);
}

.nav-container{
    width:90%;
    max-width:1200px;
    margin:auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    display:flex;
    align-items:center;
    gap:12px;
    color:#fff;
    text-decoration:none;
    font-size:22px;
    font-weight:600;
}

.logo img{
    width:45px;
    height:45px;
    object-fit:cover;
    border-radius:50%;
}

.nav-links{
    display:flex;
    align-items:center;
    gap:28px;
}

.nav-links a{
    color:#fff;
    text-decoration:none;
    font-weight:500;
    transition:.3s;
    position:relative;
    font-size:15px;
}

.nav-links a:hover{
    color:#d4af37;
}

.nav-links a::after{
    content:"";
    position:absolute;
    left:0;
    bottom:-8px;
    width:0%;
    height:2px;
    background:#d4af37;
    transition:.3s;
}

.nav-links a:hover::after{
    width:100%;
}

/* Active Page */

.nav-links a.active{
    color:#d4af37;
}

.nav-links a.active::after{
    width:100%;
}

/* Logout CTA Button */
.nav-logout-btn{
    background:rgba(212,175,55,0.15);
    color:#d4af37 !important;
    border:1px solid #d4af37;
    padding:8px 20px;
    border-radius:30px;
    font-weight:600 !important;
    display:inline-flex;
    align-items:center;
    gap:8px;
    transition:.3s ease;
    cursor:pointer;
}

.nav-logout-btn:hover{
    background:#d4af37;
    color:#111 !important;
    transform:translateY(-2px);
    box-shadow:0 4px 12px rgba(212,175,55,.3);
}

.nav-logout-btn::after{
    display:none !important;
}

@media(max-width:900px){
    .nav-links{
        display:none;
    }

    .logo{
        font-size:18px;
    }
}

/* HERO Header */

.hero{
    padding:40px 0;
    background:linear-gradient(rgba(0,0,0,.82),rgba(0,0,0,.82)), url('{{ asset("images/blog-background.jpg") }}') center/cover no-repeat;
    color:white;
}

.hero-header-flex{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:20px;
}

.hero-badge {
    display: inline-block;
    background: rgba(212, 175, 55, 0.2);
    border: 1px solid #d4af37;
    color: #d4af37;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin-bottom: 10px;
}

.hero-content h1{
    font-size:36px;
    font-weight:700;
    margin-bottom:8px;
}

.hero-content p{
    max-width:680px;
    font-size:14px;
    color:#ccc;
    line-height:1.6;
}

/* Alerts */
.alert-success {
    background: #dcfce7;
    color: #15803d;
    padding: 14px 20px;
    border-radius: 12px;
    border: 1px solid #bbf7d0;
    margin-bottom: 25px;
    font-size: 14px;
    font-weight: 500;
}

/* ================= DASHBOARD LAYOUT ================= */

.dashboard-section{
    padding:35px 0 70px;
    flex-grow:1;
}

/* Top Overview Cards Grid */

.overview-cards-grid{
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:20px;
    margin-bottom:30px;
}

.fin-summary-card{
    background:#fff;
    border-radius:16px;
    padding:22px;
    border:1px solid #e2e8f0;
    box-shadow:0 4px 12px rgba(0,0,0,.03);
    position:relative;
    overflow:hidden;
}

.fin-summary-card.highlight{
    background:linear-gradient(135deg, #111 0%, #1f1f1f 100%);
    border-color:rgba(212,175,55,.5);
    color:#fff;
}

.fin-summary-card .card-title{
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:1px;
    color:#64748b;
    font-weight:600;
    margin-bottom:6px;
    display:block;
}

.fin-summary-card.highlight .card-title{
    color:#d4af37;
}

.fin-summary-card .card-amount{
    font-size:26px;
    font-weight:700;
    color:#0f172a;
}

.fin-summary-card.highlight .card-amount{
    color:#fff;
}

.fin-summary-card .card-sub{
    font-size:12px;
    margin-top:6px;
    color:#64748b;
    display:flex;
    align-items:center;
    gap:6px;
}

.fin-summary-card.highlight .card-sub{
    color:#cbd5e1;
}

.pill-green { color:#16a34a; font-weight:600; }
.pill-red { color:#dc2626; font-weight:600; }

/* Date Filter Box Controls */

.filter-control-card {
    background: #fff;
    border-radius: 16px;
    padding: 22px 26px;
    border: 1px solid #e2e8f0;
    margin-bottom: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,.03);
}

.filter-btn-submit {
    background: #111;
    color: #d4af37;
    border: 1px solid #111;
    padding: 8px 18px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.filter-btn-submit:hover {
    background: #d4af37;
    color: #111;
}

.filter-btn-reset {
    background: #f1f5f9;
    color: #64748b;
    border: 1px solid #cbd5e1;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}

.filter-btn-reset:hover {
    background: #e2e8f0;
    color: #0f172a;
}

/* Filter Tabs & Navigation */

.view-toggle-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
    gap:15px;
}

.category-tabs{
    display:flex;
    gap:10px;
    overflow-x:auto;
}

.tab-btn{
    padding:10px 20px;
    background:#fff;
    border:1px solid #cbd5e1;
    border-radius:10px;
    font-size:13px;
    font-weight:600;
    color:#475569;
    cursor:pointer;
    transition:.25s ease;
    display:flex;
    align-items:center;
    gap:8px;
    white-space:nowrap;
    text-decoration:none;
}

.tab-btn:hover,
.tab-btn.active{
    background:#111;
    color:#d4af37;
    border-color:#111;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}

.search-box-wrap{
    position:relative;
    width:280px;
}

.search-box-wrap input{
    width:100%;
    padding:10px 14px 10px 38px;
    border-radius:10px;
    border:1px solid #cbd5e1;
    font-size:13px;
    outline:none;
    transition:.2s;
}

.search-box-wrap input:focus{
    border-color:#d4af37;
    box-shadow:0 0 0 3px rgba(212,175,55,.2);
}

.search-box-wrap svg{
    position:absolute;
    left:12px;
    top:50%;
    transform:translateY(-50%);
    color:#94a3b8;
}

/* SECTION PANELS & Visual Breakdowns */

.grid-two-columns{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:25px;
    margin-bottom:30px;
}

.panel-card{
    background:#fff;
    border-radius:18px;
    border:1px solid #e2e8f0;
    box-shadow:0 6px 20px rgba(0,0,0,.03);
    padding:25px;
}

.panel-card h3{
    font-size:18px;
    color:#0f172a;
    font-weight:700;
    margin-bottom:18px;
    display:flex;
    align-items:center;
    gap:10px;
}

.panel-card h3.income-header::before{
    content:"";
    width:4px;
    height:20px;
    background:#16a34a;
    border-radius:4px;
    display:inline-block;
}

.panel-card h3.expense-header::before{
    content:"";
    width:4px;
    height:20px;
    background:#dc2626;
    border-radius:4px;
    display:inline-block;
}

/* Category Progress Rows */

.cat-progress-item{
    margin-bottom:16px;
}

.cat-progress-label{
    display:flex;
    justify-content:space-between;
    font-size:13px;
    font-weight:600;
    color:#334155;
    margin-bottom:6px;
}

.cat-progress-track{
    height:8px;
    background:#f1f5f9;
    border-radius:10px;
    overflow:hidden;
}

.cat-progress-fill-income{
    height:100%;
    background:linear-gradient(90deg, #16a34a, #4ade80);
    border-radius:10px;
}

.cat-progress-fill-expense{
    height:100%;
    background:linear-gradient(90deg, #dc2626, #f87171);
    border-radius:10px;
}

/* Detailed Ledger Table */

.project-panel{
    background:#fff;
    border-radius:18px;
    border:1px solid #e2e8f0;
    box-shadow:0 6px 20px rgba(0,0,0,.03);
    padding:28px;
    margin-bottom:30px;
}

.panel-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    padding-bottom:15px;
    border-bottom:1px solid #f1f5f9;
    flex-wrap:wrap;
    gap:15px;
}

.panel-title-box h3{
    font-size:20px;
    color:#0f172a;
    font-weight:700;
    display:flex;
    align-items:center;
    gap:10px;
}

.panel-title-box h3::before{
    content:"";
    width:4px;
    height:20px;
    background:#d4af37;
    border-radius:4px;
    display:inline-block;
}

.table-wrapper{
    overflow-x:auto;
}

.detailed-table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

.detailed-table th{
    background:#f8fafc;
    color:#475569;
    font-weight:600;
    text-transform:uppercase;
    font-size:11px;
    letter-spacing:0.8px;
    padding:12px 16px;
    text-align:left;
    border-bottom:1px solid #e2e8f0;
}

.detailed-table td{
    padding:14px 16px;
    border-bottom:1px solid #f1f5f9;
    color:#334155;
    vertical-align:middle;
}

.detailed-table tr:hover td{
    background:#fafafa;
}

/* Category Badges */

.tag-badge{
    display:inline-block;
    padding:4px 12px;
    border-radius:20px;
    font-size:11px;
    font-weight:600;
}

/* Income Badges */
.tag-dues{ background:rgba(22, 163, 74, 0.12); color:#15803d; }
.tag-donation{ background:rgba(212, 175, 55, 0.2); color:#b38f1f; }
.tag-project-inc{ background:rgba(14, 165, 233, 0.12); color:#0369a1; }
.tag-fundraising{ background:rgba(168, 85, 247, 0.12); color:#7e22ce; }
.tag-merch{ background:rgba(236, 72, 153, 0.12); color:#be185d; }

/* Expense Badges */
.tag-wedding{ background:rgba(244, 63, 94, 0.12); color:#e11d48; }
.tag-burial{ background:rgba(71, 85, 105, 0.15); color:#334155; }
.tag-meeting{ background:rgba(99, 102, 241, 0.12); color:#4338ca; }
.tag-school{ background:rgba(245, 158, 11, 0.15); color:#b45309; }
.tag-event{ background:rgba(16, 185, 129, 0.12); color:#047857; }
.tag-project-exp{ background:rgba(14, 165, 233, 0.12); color:#0369a1; }
.tag-misc{ background:rgba(100, 116, 139, 0.12); color:#475569; }

/* Modal Styling */

.modal-backdrop{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.65);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:2000;
    backdrop-filter:blur(3px);
}

.modal-backdrop.active{
    display:flex;
}

.modal-box{
    background:#fff;
    width:90%;
    max-width:550px;
    border-radius:18px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
    position:relative;
}

.modal-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    padding-bottom:12px;
    border-bottom:1px solid #e2e8f0;
}

.modal-header h3{
    font-size:18px;
    color:#0f172a;
    font-weight:700;
}

.close-modal-btn{
    background:none;
    border:none;
    font-size:22px;
    color:#94a3b8;
    cursor:pointer;
}

.form-group{
    margin-bottom:16px;
}

.form-group label{
    display:block;
    font-size:12px;
    font-weight:600;
    color:#475569;
    margin-bottom:6px;
    text-transform:uppercase;
}

.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    padding:10px 14px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    font-size:13px;
    outline:none;
}

.form-group input:focus,
.form-group select:focus{
    border-color:#d4af37;
}

.modal-submit-btn{
    width:100%;
    background:#111;
    color:#d4af37;
    font-weight:600;
    padding:12px;
    border-radius:10px;
    border:1px solid #d4af37;
    cursor:pointer;
    font-size:14px;
    margin-top:10px;
    transition:.25s;
}

.modal-submit-btn:hover{
    background:#d4af37;
    color:#111;
}

/* FOOTER */

.footer{
    background:#111;
    color:#fff;
    padding:70px 0 30px;
}

.footer-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:60px;
}

.footer-logo{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:20px;
}

.footer-logo img{
    width:60px;
    height:60px;
    border-radius:50%;
    object-fit:cover;
}

.footer-logo h3{
    font-size:20px;
    line-height:1.4;
}

.footer-about p{
    color:#bbb;
    line-height:1.7;
    font-size:13px;
}

.footer-contact h3{
    margin-bottom:20px;
    color:#d4af37;
    font-size:18px;
}

.footer-contact p{
    color:#bbb;
    margin-bottom:12px;
    font-size:13px;
}

.footer-bottom{
    border-top:1px solid rgba(255,255,255,.1);
    margin-top:50px;
    padding-top:25px;
    text-align:center;
    color:#888;
    font-size:13px;
}

@media(max-width:1024px){
    .overview-cards-grid,
    .grid-two-columns{
        grid-template-columns:1fr 1fr;
    }
}

@media(max-width:640px){
    .overview-cards-grid,
    .grid-two-columns{
        grid-template-columns:1fr;
    }
    
    .hero-header-flex{
        flex-direction:column;
        align-items:flex-start;
    }
}
</style>
</head>

<body>

<nav>
    <div class="nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/Barons Logo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
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

        <!-- OVERVIEW SUMMARY CARDS -->
        <div class="overview-cards-grid">
            <div class="fin-summary-card highlight">
                <span class="card-title">Net Cash Available</span>
                <div class="card-amount">₱{{ number_format($netCash, 2) }}</div>
                <div class="card-sub">
                    <span >↑ Active Society Reserve</span>
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
                    <span >Active Alumni Contributions</span>
                </div>
            </div>
        </div>

        <!-- ENHANCED DATE RANGE & FISCAL YEAR FILTER FOR PERCENTAGE BREAKDOWN -->
        <div class="filter-control-card" id="breakdown-section">
            <form action="{{ route('financial') }}#breakdown-section" method="GET" id="dateFilterForm">
                @foreach(request()->except(['year', 'start_date', 'end_date', 'page']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 16px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div>
                            <h4 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0;">Breakdown Date & Fiscal Year Filter</h4>
                            <p style="font-size: 12px; color: #64748b; margin: 2px 0 0 0;">Filter percentage distribution of inflow and outflow by custom dates or fiscal years</p>
                        </div>
                    </div>

                    <!-- Selected Period Badge -->
                    
                </div>

                <!-- Input Field Controls Grid -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; align-items: end;">
                    
                    <!-- Start Date -->
                    <div>
                        <label for="start_date_input" style="display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px;">Start Date</label>
                        <input type="date" name="start_date" id="start_date_input" value="{{ request('start_date') }}" 
                               style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; outline: none; background: #fff; color: #0f172a;">
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date_input" style="display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px;">End Date</label>
                        <input type="date" name="end_date" id="end_date_input" value="{{ request('end_date') }}" 
                               style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; outline: none; background: #fff; color: #0f172a;">
                    </div>

                    <!-- Fiscal Year Preset Dropdown -->
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

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 8px;">
                        <button type="submit" class="filter-btn-submit">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                            Apply Filter
                        </button>
                        <a href="{{ route('financial') }}#breakdown-section" class="filter-btn-reset">Reset</a>
                    </div>
                </div>

                <!-- Quick Date Pills -->
            </form>
        </div>

        <div class="grid-two-columns">
            <!-- Funds In Breakdown -->
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

            <!-- Funds Out Breakdown -->
            <div class="panel-card">
                <h3 class="expense-header" style="display: flex;  align-items: center;">
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

        <div class="project-panel" id="ledger-section">
            <div class="panel-header">
                <div class="panel-title-box">
                    <h3>Itemized Financial Ledger</h3>
                    <p>Live database records of all society income collections and disbursed expense transactions</p>
                </div>

                <form action="{{ route('financial') }}#ledger-section" method="GET" class="search-box-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search donor, item, title..." onchange="this.form.submit()">
                </form>
            </div>

            <!-- FILTER BUTTON TABS -->
            <div class="view-toggle-bar">
                <div class="category-tabs">
                    <a href="{{ route('financial') }}#ledger-section" class="tab-btn {{ !request('flow_type') && !request('category') ? 'active' : '' }}">All Entries</a>
                    <a href="{{ route('financial', ['flow_type' => 'INCOME']) }}#ledger-section" class="tab-btn {{ request('flow_type') === 'INCOME' ? 'active' : '' }}">Funds In (Income)</a>
                    <a href="{{ route('financial', ['flow_type' => 'EXPENSE']) }}#ledger-section" class="tab-btn {{ request('flow_type') === 'EXPENSE' ? 'active' : '' }}">Funds Out (Expenses)</a>
                    <a href="{{ route('financial', ['category' => 'dues']) }}#ledger-section" class="tab-btn {{ request('category') === 'dues' ? 'active' : '' }}">Member Dues</a>
                    <a href="{{ route('financial', ['category' => 'burial']) }}#ledger-section" class="tab-btn {{ request('category') === 'burial' ? 'active' : '' }}">Burial Aid</a>
                    <a href="{{ route('financial', ['category' => 'school']) }}#ledger-section" class="tab-btn {{ request('category') === 'school' ? 'active' : '' }}">School Donation</a>
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
                                No financial transactions found in Supabase database.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

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
                    <!-- Populated via Javascript -->
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
                    <img src="{{ asset('images/Barons Logo.png') }}" alt="" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
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

// Date & Year Filter Helpers
function clearCustomDatesAndSubmit() {
    document.getElementById('start_date_input').value = '';
    document.getElementById('end_date_input').value = '';
    document.getElementById('dateFilterForm').submit();
}

function applyYearPreset(year) {
    document.getElementById('start_date_input').value = '';
    document.getElementById('end_date_input').value = '';
    document.getElementById('breakdown_year_select').value = year;
    document.getElementById('dateFilterForm').submit();
}

function applyQuickPreset(type) {
    if (type === 'all') {
        document.getElementById('start_date_input').value = '';
        document.getElementById('end_date_input').value = '';
        document.getElementById('breakdown_year_select').value = 'all';
        document.getElementById('dateFilterForm').submit();
    }
}

function applyDateRangePreset(start, end) {
    document.getElementById('start_date_input').value = start;
    document.getElementById('end_date_input').value = end;
    document.getElementById('breakdown_year_select').value = 'all';
    document.getElementById('dateFilterForm').submit();
}

// Automatically keep user scrolled at the breakdown or ledger section when applying filters
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