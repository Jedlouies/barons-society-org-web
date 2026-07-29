<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Barons Society | Dashboard</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/BaronsLogo.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<nav>
    <div class="container nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/BaronsLogo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
            <span>Barons Society Incorporated</span>
        </a>

        <div class="nav-links">
            <a href="{{ url('/dashboard') }}" class="active">Dashboard</a>
            <a href="{{ url('/blogs') }}">News and Updates</a>
            <a href="{{ url('/member-classes') }}">Classes</a>
            <a href="{{ url('/bylaws') }}">Bylaws</a>
            <a href="{{ url('/financial') }}">Funds</a>

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
    <div class="container hero-header-flex">
        <div class="hero-content">
            <h1>Dashboard</h1>
            <p>
                Welcome to the Barons Society official member portal. Stay updated with current society activities, review class directories, and access internal alumni resources.
            </p>
        </div>
    </div>
</section>

<section class="dashboard-section">
    <div class="container">

        <!-- Summary Metric Cards -->
        <div class="cards-grid">
            <div class="stat-card">
                <div class="stat-details">
                    <h4>Total Members</h4>
                    <h2>{{ number_format($totalMembers) }}</h2>
                </div>
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-details">
                    <h4>Total Classes</h4>
                    <h2>{{ number_format($totalClasses) }}</h2>
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

            <!-- Left Panel Column -->
            <div style="display: flex; flex-direction: column; gap: 24px;">

                <!-- Official Announcements Panel -->
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-header-title">
                            <h3>Official Announcements</h3>
                        </div>
                    </div>

                    <div class="announcements-list">
                        @forelse ($announcements as $announcement)
                            <article class="announcement-item {{ strtolower($announcement->type) === 'urgent' ? 'urgent' : 'general' }}">
                                <div class="announcement-meta">
                                    <span class="announcement-badge {{ strtolower($announcement->type) === 'urgent' ? 'badge-urgent' : 'badge-general' }}">
                                        {{ ucfirst($announcement->type) }}
                                    </span>
                                    <time class="announcement-date">
                                        Posted: {{ $announcement->created_at->format('M d, Y') }}
                                    </time>
                                </div>

                                <h4 class="announcement-title">{{ $announcement->title }}</h4>
                                <p class="announcement-text">{{ $announcement->content }}</p>
                            </article>
                        @empty
                            <div style="text-align: center; color: #888; padding: 20px 0; font-size: 14px;">
                                No active announcements at this time.
                            </div>
                        @endforelse
                    </div>                
                </div>

                <!-- Recent Activity Log Panel -->
                <div class="panel">
                    <div class="panel-header">
                        <h3>Recent Society Activity</h3>
                    </div>

                    <ul class="activity-list">
                        @forelse ($recentActivities as $activity)
                            <li class="activity-item">
                                <div class="activity-dot"></div>
                                <div class="activity-details">
                                    <p>{{ $activity->description }}</p>
                                    <span>{{ $activity->time_ago }} • {{ $activity->type }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="activity-item">
                                <div class="activity-details">
                                    <p style="color: #94a3b8;">No recent major activities recorded yet.</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>

            </div>

            <!-- Right Panel Column -->
            <div>
                <!-- User Status Card with Actions -->
                <div class="user-profile-card">
                    <span class="user-badge">{{ $memberPosition ?? 'Active Alumni Member' }}</span>
                    <h3>
                        @if (!empty($memberDetails['first_name']) || !empty($memberDetails['last_name']))
                            {{ trim(($memberDetails['first_name'] ?? '') . ' ' . ($memberDetails['last_name'] ?? '')) }}
                        @else
                            {{ Auth::user()->name ?? 'Barons Member' }}
                        @endif
                    </h3>
                    <p>{{ Auth::user()->email ?? 'member@baronssociety.org' }}</p>

                    <div class="profile-actions-container">
                        <a href="javascript:void(0)" onclick="openUpdateProfileModal()" class="btn-profile-action btn-update-profile">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>Update Profile Info</span>
                        </a>

                        <a href="javascript:void(0)" onclick="alert('Password reset link sent to your registered email.')" class="btn-profile-action btn-change-password">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <span>Change Password</span>
                        </a>
                    </div>
                </div>

                <!-- Quick Actions Panel -->
                <div class="panel">
                    <div class="panel-header">
                        <h3>Quick Navigation</h3>
                    </div>

                    <div class="quick-actions-grid">
                        <a href="{{ url('/member-classes') }}" class="action-btn">
                            <span>Browse Classes & Members</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>

                        <a href="{{ url('/blogs') }}" class="action-btn">
                            <span>Read Latest News Articles</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>

                        <a href="{{ url('/financial') }}" class="action-btn">
                            <span>Funds (Society Treasury)</span>
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

@if(in_array(strtolower($memberPosition ?? ''), ['admin', 'administrator']))
<div class="fab-container">
    <button class="fab-btn" id="fabToggle" type="button" aria-label="Add New Item">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
    </button>

    <div class="fab-dropdown" id="fabMenu">
        <a href="javascript:void(0)" class="fab-item" onclick="openNewsModal()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-4-3H9M9 12h6m-6 4h4"/></svg>
            <span>Add News and Updates</span>
        </a>
        <a href="javascript:void(0)" class="fab-item" onclick="openMemberModal()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/>
            </svg>
            <span>Add New Member</span>
        </a>
        <a href="javascript:void(0)" class="fab-item" onclick="openClassModal()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            <span>Add New Class</span>
        </a>
        <a href="javascript:void(0)" class="fab-item" onclick="openAnnouncementModal()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            <span>Add Announcement</span>
        </a>
    </div>
</div>

@include('partials.add-news-modal')
@include('partials.add-announcement-modal')
@include('partials.add-member-modal')
@include('partials.add-class-modal')
@include('partials.update-profile-modal')
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
                    Building Brotherhood, Leadership, and Service through
                    unity, patriotism, and community engagement. Honoring our
                    legacy while inspiring future generations.
                </p>
            </div>

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fabToggle = document.getElementById('fabToggle');
    const fabMenu   = document.getElementById('fabMenu');

    if (fabToggle && fabMenu) {
        fabToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            fabMenu.classList.toggle('active');
            fabToggle.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!fabMenu.contains(e.target) && !fabToggle.contains(e.target)) {
                fabMenu.classList.remove('active');
                fabToggle.classList.remove('open');
            }
        });
    }
});
</script>

</body>
</html>