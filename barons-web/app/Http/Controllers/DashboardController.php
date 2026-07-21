<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Barons Society | Member Dashboard</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="https://barons-society.onrender.com/images/Barons%20Logo.png" type="image/png">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f5f5f5;
    color:#222;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.container{
    width:90%;
    max-width:1200px;
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

/* HERO */

.hero{
    height:300px;
    background:
    linear-gradient(rgba(0,0,0,.7),rgba(0,0,0,.7)),
    url('{{ asset("images/blog-background.jpg") }}');
    background-size:cover;
    background-position:center;
    display:flex;
    align-items:center;
}

.hero-content{
    color:white;
}

.hero-badge {
    display: inline-block;
    background: rgba(212, 175, 55, 0.2);
    border: 1px solid #d4af37;
    color: #d4af37;
    padding: 4px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 12px;
}

.hero-content h1{
    font-size:48px;
    margin-bottom:10px;
    font-weight:700;
}

.hero-content p{
    max-width:700px;
    font-size:16px;
    color:#ddd;
    line-height:1.6;
}

/* ===========================
   DASHBOARD CONTENT SECTION
=========================== */

.dashboard-section{
    padding:50px 0 80px;
    flex-grow:1;
}

/* Metric Cards */

.cards-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
    margin-bottom:35px;
}

.stat-card{
    background:#fff;
    border-radius:16px;
    padding:24px;
    border:1px solid #eaeaea;
    box-shadow:0 6px 18px rgba(0,0,0,.04);
    display:flex;
    align-items:center;
    justify-content:space-between;
    transition:.3s ease;
}

.stat-card:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 25px rgba(0,0,0,.08);
    border-color:#d4af37;
}

.stat-details h4{
    color:#888;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:1px;
    margin-bottom:6px;
    font-weight:600;
}

.stat-details h2{
    font-size:32px;
    color:#111;
    font-weight:700;
}

.stat-icon{
    width:52px;
    height:52px;
    border-radius:14px;
    background:rgba(212,175,55,.12);
    color:#d4af37;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* Content Grid Layout */

.dashboard-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:30px;
}

.panel{
    background:#fff;
    border-radius:18px;
    padding:30px;
    border:1px solid #eaeaea;
    box-shadow:0 6px 20px rgba(0,0,0,.04);
    margin-bottom:25px;
}

.panel-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:22px;
    padding-bottom:15px;
    border-bottom:1px solid #f0f0f0;
}

.panel-header h3{
    font-size:18px;
    color:#111;
    font-weight:700;
    display:flex;
    align-items:center;
    gap:10px;
}

.panel-header h3::before{
    content:"";
    width:4px;
    height:18px;
    background:#d4af37;
    border-radius:4px;
    display:inline-block;
}

/* User Status Card */

.user-profile-card{
    background:linear-gradient(135deg, #111 0%, #1f1f1f 100%);
    color:#fff;
    border-radius:18px;
    padding:28px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
    border:1px solid rgba(212,175,55,.3);
    margin-bottom:25px;
    position:relative;
    overflow:hidden;
}

.user-profile-card::after{
    content:"";
    position:absolute;
    right:-20px;
    bottom:-20px;
    width:120px;
    height:120px;
    background:rgba(212,175,55,.05);
    border-radius:50%;
    pointer-events:none;
}

.user-badge{
    display:inline-block;
    padding:4px 12px;
    background:#d4af37;
    color:#111;
    font-size:11px;
    font-weight:700;
    border-radius:20px;
    text-transform:uppercase;
    margin-bottom:12px;
    letter-spacing:1px;
}

.user-profile-card h3{
    font-size:22px;
    font-weight:700;
    margin-bottom:4px;
}

.user-profile-card p{
    color:#a3a3a3;
    font-size:13px;
    margin-bottom:20px;
}

.user-meta-list{
    display:flex;
    flex-direction:column;
    gap:10px;
    border-top:1px solid rgba(255,255,255,.1);
    padding-top:15px;
    font-size:13px;
}

.user-meta-item{
    display:flex;
    justify-content:space-between;
    color:#ccc;
}

.user-meta-item strong{
    color:#d4af37;
}

/* Recent Activity List */

.activity-list{
    list-style:none;
}

.activity-item{
    display:flex;
    align-items:flex-start;
    gap:16px;
    padding:14px 0;
    border-bottom:1px solid #f5f5f5;
}

.activity-item:last-child{
    border-bottom:none;
}

.activity-dot{
    width:10px;
    height:10px;
    background:#d4af37;
    border-radius:50%;
    margin-top:6px;
    flex-shrink:0;
}

.activity-details p{
    font-size:14px;
    color:#333;
    font-weight:500;
    line-height:1.4;
}

.activity-details span{
    font-size:12px;
    color:#999;
}

/* Quick Actions */

.quick-actions-grid{
    display:grid;
    grid-template-columns:1fr;
    gap:12px;
}

.action-btn{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:14px 18px;
    background:#fafafa;
    border:1px solid #eaeaea;
    color:#222;
    text-decoration:none;
    border-radius:12px;
    font-size:14px;
    font-weight:600;
    transition:.3s ease;
}

.action-btn:hover{
    background:#111;
    color:#fff;
    border-color:#111;
    transform:translateX(4px);
}

.action-btn svg{
    color:#d4af37;
    transition:.3s;
}

.action-btn:hover svg{
    transform:translateX(4px);
}

/* Responsive Layout */

@media(max-width:1000px){
    .cards-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .dashboard-grid{
        grid-template-columns:1fr;
    }
}

@media(max-width:600px){
    .cards-grid{
        grid-template-columns:1fr;
    }

    .hero-content h1{
        font-size:32px;
    }

    .panel{
        padding:20px;
    }
}

/* FOOTER */

.footer{
    background:#111;
    color:#fff;
    padding:80px 0 30px;
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
    margin-bottom:25px;
}

.footer-logo img{
    width:70px;
    height:70px;
    border-radius:50%;
    object-fit:cover;
}

.footer-logo h3{
    font-size:22px;
    line-height:1.4;
}

.footer-about p{
    color:#bbb;
    line-height:1.8;
}

.footer-contact h3{
    margin-bottom:25px;
    color:#d4af37;
}

.footer-contact p{
    color:#bbb;
    margin-bottom:15px;
}

.socials{
    margin-top:20px;
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.socials a{
    color:#bbb;
    text-decoration:none;
    transition:.3s;
}

.socials a:hover{
    color:#d4af37;
}

.footer-bottom{
    border-top:1px solid rgba(255,255,255,.1);
    margin-top:60px;
    padding-top:30px;
    text-align:center;
    color:#888;
    font-size:14px;
}
</style>
</head>

<body>

<nav>
    <div class="container nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/Barons Logo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
            <span>Barons Society Incorporated</span>
        </a>

        <div class="nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/blogs') }}">News and Updates</a>
            <a href="{{ url('/classes') }}">Classes</a>
            <a href="{{ url('/bylaws') }}">Bylaws</a>
            <a href="{{ url('/dashboard') }}" class="active">Dashboard</a>

            <!-- Explicit Logout Action -->
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="nav-logout-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container hero-content">
        <span class="hero-badge">Alumni Portal</span>
        <h1>Member Dashboard</h1>
        <p>
            Welcome to the Barons Society official member portal. Stay updated with current society activities, review class directories, and access internal alumni resources.
        </p>
    </div>
</section>

<section class="dashboard-section">
    <div class="container">

        <!-- Summary Metric Cards -->
        <div class="cards-grid">
            <div class="stat-card">
                <div class="stat-details">
                    <h4>Total Members</h4>
                    <h2>{{ $totalMembers ?? 500 }}</h2>
                </div>
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-details">
                    <h4>Total Classes</h4>
                    <h2>{{ $totalClasses ?? 12 }}</h2>
                </div>
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-details">
                    <h4>News Articles</h4>
                    <h2>{{ $totalBlogs ?? 8 }}</h2>
                </div>
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-4-3H9M9 12h6m-6 4h4"/></svg>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-details">
                    <h4>Gallery Photos</h4>
                    <h2>{{ $totalPhotos ?? 45 }}</h2>
                </div>
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
        </div>

        <!-- Dashboard Two-Column Grid -->
        <div class="dashboard-grid">

            <!-- Left Panel: Recent Activity Log -->
            <div>
                <div class="panel">
                    <div class="panel-header">
                        <h3>Recent Society Activity</h3>
                    </div>

                    <ul class="activity-list">
                        <li class="activity-item">
                            <div class="activity-dot"></div>
                            <div class="activity-details">
                                <p>Annual Fellowship & 36th Anniversary Celebration successfully organized at 4ID Officer's Clubhouse.</p>
                                <span>2 days ago • Official Event</span>
                            </div>
                        </li>

                        <li class="activity-item">
                            <div class="activity-dot"></div>
                            <div class="activity-details">
                                <p>Added 24 new verified alumni members to Alpha Pioneers Class list.</p>
                                <span>1 week ago • Membership Update</span>
                            </div>
                        </li>

                        <li class="activity-item">
                            <div class="activity-dot"></div>
                            <div class="activity-details">
                                <p>Published Paskong Pinoy Community Outreach Program event report.</p>
                                <span>2 weeks ago • Outreach</span>
                            </div>
                        </li>

                        <li class="activity-item">
                            <div class="activity-dot"></div>
                            <div class="activity-details">
                                <p>Updated corporate bylaws document in accordance with SEC requirements.</p>
                                <span>3 weeks ago • Governance</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Panel: User Status Card & Quick Actions -->
            <div>
                <!-- User Profile Summary Card -->
                <div class="user-profile-card">
                    <span class="user-badge">Active Alumni Member</span>
                    <h3>{{ Auth::user()->name ?? 'Barons Member' }}</h3>
                    <p>{{ Auth::user()->email ?? 'member@baronssociety.org' }}</p>

                    <div class="user-meta-list">
                        <div class="user-meta-item">
                            <span>Status:</span>
                            <strong>SEC Verified</strong>
                        </div>
                        <div class="user-meta-item">
                            <span>Access Level:</span>
                            <strong>Alumni Member Portal</strong>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Panel -->
                <div class="panel">
                    <div class="panel-header">
                        <h3>Quick Navigation</h3>
                    </div>

                    <div class="quick-actions-grid">
                        <a href="{{ url('/classes') }}" class="action-btn">
                            <span>Browse Classes & Members</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>

                        <a href="{{ url('/blogs') }}" class="action-btn">
                            <span>Read Latest News Articles</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>

                        <a href="{{ url('/bylaws') }}" class="action-btn">
                            <span>View Constitution & Bylaws</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- About -->
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="{{ asset('images/Barons Logo.png') }}" alt="" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
                    <h3>Barons Society<br>ROTC Alumni Incorporated</h3>
                </div>

                <p>
                    Building Brotherhood, Leadership, and Service through
                    unity, patriotism, and community engagement. Honoring our
                    legacy while inspiring future generations.
                </p>
            </div>

            <!-- Contact -->
            <div class="footer-contact">
                <h3>Contact Us</h3>

                <p>📍 Cagayan de Oro City, Philippines</p>
                <p>📧 info@baronssociety.org</p>
                <p>📞 +63 912 345 6789</p>

                <div class="socials">
                    <a href="#">Facebook</a>
                    <a href="#">YouTube</a>
                    <a href="#">Instagram</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} Barons Society ROTC Alumni Incorporated. SEC No. 2022080064500-05.
            All Rights Reserved.
        </div>
    </div>
</footer>

</body>
</html>