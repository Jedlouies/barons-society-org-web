<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Barons Society | Dashboard</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/Barons Logo.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<nav>
    <div class="container nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/Barons Logo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
            <span>Barons Society Incorporated</span>
        </a>

        <div class="nav-links">
            <a href="{{ url('/dashboard') }}" class="active">Dashboard</a>
            <a href="{{ url('/blogs') }}">News and Updates</a>
            <a href="{{ url('/member-classes') }}">Classes</a>
            <a href="{{ url('/bylaws') }}">Bylaws</a>
            <a href="{{ url('/financial') }}">Funds</a>

            <!-- Robust Native Form Logout Button -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-logout-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container hero-content">
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