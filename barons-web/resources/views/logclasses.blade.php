<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Barons Society | Classes</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/BaronsLogo.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<style>
/* Section Titles inside Expanded Content */
.staff-section-title {
    font-size: 14px;
    font-weight: 700;
    color: #111;
    margin: 20px 0 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.staff-section-title::before {
    content: "";
    width: 4px;
    height: 16px;
    background: #d4af37;
    border-radius: 4px;
}

/* Command Staff Container (Light Theme) */
.officers-container {
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 24px;
}

.officers-container .staff-section-title {
    color: #8c6d13;
    margin-top: 0;
}

/* Grids */
.officers-grid,
.member-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 16px;
}

/* Shared Member & Officer Card Design */
.member-detail-card {
    background: #ffffff;
    border: 1px solid #eaeaea;
    border-radius: 14px;
    padding: 16px;
    display: flex;
    gap: 14px;
    align-items: flex-start;
    transition: all 0.25s ease;
}

.member-detail-card:hover {
    border-color: #d4af37;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
}

/* Officer Card Accent */
.officer-card {
    border: 1px solid rgba(212, 175, 55, 0.4);
    background: #fffdf8;
}

.officer-card:hover {
    border-color: #d4af37;
    box-shadow: 0 6px 18px rgba(212, 175, 55, 0.12);
}

/* Avatars */
.member-avatar {
    width: 62px;
    height: 62px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 2px solid #e0e0e0;
    background: #111;
}



.member-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Member Content Info */
.member-info {
    flex-grow: 1;
}

.member-info h4 {
    font-size: 15px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px;
    line-height: 1.3;
}

.member-nickname {
    font-size: 12.5px;
    font-weight: 500;
    color: #b38f1f;
}

/* Badges */
.officer-badge {
    display: inline-block;
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    background: #d4af37;
    color: #ffffff;
    padding: 2px 10px;
    border-radius: 12px;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}

/* Metadata List */
.member-meta-details {
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 12px;
    color: #555;
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.member-meta-details li strong {
    color: #222;
    font-weight: 600;
}

/* Clickable Avatar Indicator */
.member-avatar img {
    cursor: pointer;
    transition: transform 0.2s ease, filter 0.2s ease;
}

.member-avatar img:hover {
    transform: scale(1.05);
    filter: brightness(1.1);
}

/* Lightbox Modal Overlay */
.image-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(4px);
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-modal.active {
    display: flex;
    opacity: 1;
}

/* Lightbox Content */
.image-modal-content {
    max-width: 90%;
    max-height: 85vh;
    border-radius: 12px;
    border: 2px solid #d4af37;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    transform: scale(0.9);
    transition: transform 0.3s ease;
    object-fit: contain;
}

.image-modal.active .image-modal-content {
    transform: scale(1);
}

/* Close Button */
.image-modal-close {
    position: absolute;
    top: 20px;
    right: 25px;
    color: #fff;
    font-size: 32px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.2s;
    user-select: none;
}

.image-modal-close:hover {
    color: #d4af37;
}
</style>

</head>

<body>

<nav>
    <div class="container nav-container">
        <div class="logo">
            <img src="{{ asset('images/BaronsLogo.png') }}" alt="Barons Logo">
            Barons Society Incorporated
        </div>

        <div class="nav-links">
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            <a href="{{ url('/blogs') }}">News and Updates</a>
            <a href="{{ url('/member-classes') }}" class="active">Classes</a>
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
            <h1>Barons Members</h1>
            <p>
                The Barons Society has a rich history of classes that have contributed to the growth and development of the organization. Each class represents a unique group of individuals who have come together to make a difference in their communities and beyond.
            </p>
        </div>
    </div>
</section>

<section class="classes">
    <div class="container">

        @foreach($classes as $class)
        <div class="class-card">

            <div class="class-row">
                <div class="class-logo">
                    @if(!empty($class['class_logo']))
                        <img src="{{ $class['class_logo'] }}" alt="{{ $class['class_name'] }}">
                    @else
                        <img src="{{ asset('images/BaronsLogo.png') }}" alt="Barons Logo">
                    @endif
                </div>

                <div class="class-info">
                    <div class="class-number">
                        {{ $class['class_name'] }}
                    </div>
    
                </div>

                <div class="summary-item">
                    <span class="label">Corps Commander</span>
                    <strong>{{ $class['corps_commander'] ?? 'N/A' }}</strong>
                </div>

                <div class="summary-item">
                    <span class="label">Members</span>
                    <strong>{{ count($class['members']) }} Alumni</strong>
                </div>

                <div class="summary-item">
                    <span class="label">Batch</span>
                    <strong>{{ $class['batch_year'] ?? 'N/A' }}</strong>
                </div>

                <div class="button-area">
                    <button class="view-btn">
                        View Members ▼
                    </button>
                </div>
            </div>

            <!-- Expanded Class Directory Content -->
            <div class="class-content">
                <div class="members-list">

                    @php
                        $officerRoles = [
                            'Corps Commander', 'Executive Officer', 'S1', 'S2', 'S3', 'S4', 'S7'
                        ];

                        $membersCollection = collect($class['members'] ?? []);
                        
                        // Separate officers and standard members
                        $officers = $membersCollection->filter(function($m) use ($officerRoles) {
                            return in_array($m['cadet_role'] ?? '', $officerRoles);
                        })->sortBy(function($m) use ($officerRoles) {
                            return array_search($m['cadet_role'] ?? '', $officerRoles);
                        });

                        $generalMembers = $membersCollection->reject(function($m) use ($officerRoles) {
                            return in_array($m['cadet_role'] ?? '', $officerRoles);
                        });
                    @endphp

                    <!-- Command Staff & Officers Container -->
                    @if($officers->count() > 0)
                        <div class="officers-container">
                            <h3 class="staff-section-title">Command Staff & Officers</h3>
                            <div class="officers-grid">
                                @foreach($officers as $officer)
                                    <div class="member-detail-card officer-card">
                                        @php
                                            $officerFullName = trim(($officer['first_name'] ?? '') . ' ' . ($officer['last_name'] ?? ''));
                                            $defaultOfficerAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($officerFullName ?: 'Officer') . '&background=0f172a&color=d4af37&size=256&bold=true';
                                        @endphp

                                        <div class="member-avatar officer-avatar">
                                            <img src="{{ !empty($officer['profile_photo']) ? $officer['profile_photo'] : $defaultOfficerAvatar }}" 
                                                alt="{{ $officer['first_name'] ?? 'Officer' }}"
                                                onerror="this.onerror=null;this.src='{{ $defaultOfficerAvatar }}';">
                                        </div>

                                        <div class="member-info">
                                            <h4>
                                                {{ $officer['first_name'] }}
                                                @if(!empty($officer['middle_name']))
                                                    {{ strtoupper(substr($officer['middle_name'], 0, 1)) }}.
                                                @endif
                                                {{ $officer['last_name'] }}
                                                @if(!empty($officer['suffix']))
                                                    {{ $officer['suffix'] }}
                                                @endif

                                                @if(!empty($officer['nickname']))
                                                    <span class="member-nickname">("{{ $officer['nickname'] }}")</span>
                                                @endif
                                            </h4>

                                            <span class="officer-badge">{{ $officer['cadet_role'] }}</span>

                                            <ul class="member-meta-details">
                                                @if(!empty($officer['gender']))
                                                    <li><strong>Gender:</strong> {{ $officer['gender'] }}</li>
                                                @endif

                                        

                                                @if(!empty($officer['occupation']))
                                                    <li>
                                                        <strong>Occupation:</strong> {{ $officer['occupation'] }}
                                                        @if(!empty($officer['company']))
                                                            at {{ $officer['company'] }}
                                                        @endif
                                                    </li>
                                                @endif

                                              

                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- General Class Members Section -->
                    <h3 class="staff-section-title">Class Members</h3>
                    <div class="member-cards-grid">
                        @forelse($generalMembers as $member)
                            <div class="member-detail-card">
                                @php
                                    $memberFullName = trim(($member['first_name'] ?? '') . ' ' . ($member['last_name'] ?? ''));
                                    $defaultMemberAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($memberFullName ?: 'Member') . '&background=1e293b&color=ffffff&size=256&bold=true';
                                @endphp

                                <div class="member-avatar">
                                    <img src="{{ !empty($member['profile_photo']) ? $member['profile_photo'] : $defaultMemberAvatar }}" 
                                        alt="{{ $member['first_name'] ?? 'Member' }}"
                                        onerror="this.onerror=null;this.src='{{ $defaultMemberAvatar }}';">
                                </div>

                                <div class="member-info">
                                    <h4>
                                        {{ $member['first_name'] }}
                                        @if(!empty($member['middle_name']))
                                            {{ strtoupper(substr($member['middle_name'], 0, 1)) }}.
                                        @endif
                                        {{ $member['last_name'] }}
                                        @if(!empty($member['suffix']))
                                            {{ $member['suffix'] }}
                                        @endif

                                        @if(!empty($member['nickname']))
                                            <span class="member-nickname">("{{ $member['nickname'] }}")</span>
                                        @endif
                                    </h4>

                                    <ul class="member-meta-details">
                                        @if(!empty($member['gender']))
                                            <li><strong>Gender:</strong> {{ $member['gender'] }}</li>
                                        @endif

                            

                                        @if(!empty($member['occupation']))
                                            <li>
                                                <strong>Occupation:</strong> {{ $member['occupation'] }}
                                                @if(!empty($member['company']))
                                                    at {{ $member['company'] }}
                                                @endif
                                            </li>
                                        @endif

                                     

                                       

                                       
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <div style="grid-column: 1 / -1; text-align: center; color: #888; padding: 20px;">
                                No standard members registered under this class yet.
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>
        @endforeach

    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="{{ asset('images/BaronsLogo.png') }}" alt="Barons Logo" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
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

<div id="avatarModal" class="image-modal" aria-hidden="true">
    <span class="image-modal-close">&times;</span>
    <img class="image-modal-content" id="modalTargetImage" alt="Enlarged Profile View">
</div>

<script>
document.querySelectorAll(".view-btn").forEach(button => {
    button.addEventListener("click", function () {
        const card = this.closest(".class-card");
        const content = card.querySelector(".class-content");

        content.classList.toggle("active");

        this.textContent = content.classList.contains("active")
            ? "Hide Members ▲"
            : "View Members ▼";
    });
});

// --- Profile Image Zoom Lightbox Logic ---
const modal = document.getElementById("avatarModal");
const modalImg = document.getElementById("modalTargetImage");
const closeBtn = document.querySelector(".image-modal-close");

// Attach click listener to all member & officer avatars
document.addEventListener("click", function (e) {
    if (e.target.matches(".member-avatar img")) {
        const imageSrc = e.target.getAttribute("src");
        if (imageSrc) {
            modalImg.src = imageSrc;
            modal.classList.add("active");
            modal.setAttribute("aria-hidden", "false");
        }
    }
});

// Close modal when clicking close button or background overlay
const closeModal = () => {
    modal.classList.remove("active");
    modal.setAttribute("aria-hidden", "true");
};

closeBtn.addEventListener("click", closeModal);
modal.addEventListener("click", function (e) {
    if (e.target === modal) {
        closeModal();
    }
});

// Close modal on Pressing 'Escape' key
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && modal.classList.contains("active")) {
        closeModal();
    }
});
</script>



</body>
</html>