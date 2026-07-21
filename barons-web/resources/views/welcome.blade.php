<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barons Society | Home</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="https://barons-society.onrender.com/images/Barons%20Logo.png" type="image/png">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

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
    gap:35px;
}

.nav-links a{
    color:#fff;
    text-decoration:none;
    font-weight:500;
    transition:.3s;
    position:relative;
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
    height:90vh;
    background:
        linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
        url("{{asset('images/hero background.jpg')}}");
    background-size:cover;
    background-position:center;
    display:flex;
    align-items:center;
}

.hero-content{
    color:#fff;
    max-width:800px;
}

.hero-badge{
    display:inline-block;
    background:rgba(255,255,255,.15);
    backdrop-filter:blur(10px);
    padding:10px 20px;
    border-radius:50px;
    font-size:14px;
    letter-spacing:2px;
    margin-bottom:25px;
    border:1px solid rgba(255,255,255,.2);
}

.hero-content h1{
    font-size:70px;
    line-height:1.1;
    font-weight:700;
    text-transform:uppercase;
    text-shadow:0 5px 20px rgba(0,0,0,.4);
}

.hero-content h1 span{
    color:#d4af37;
    display:block;
}

.hero-line{
    width:120px;
    height:5px;
    background:#d4af37;
    border-radius:50px;
    margin:30px 0;
}

.hero-content p{
    font-size:22px;
    line-height:1.8;
    max-width:700px;
    color:#f1f1f1;
    margin-bottom:30px;
}

.hero-buttons{
    display:flex;
    gap:20px;
}

.btn{
    padding:15px 30px;
    border-radius:50px;
    text-decoration:none;
    font-weight:600;
}

.btn-primary{
    background:#fff;
    color:#000;
    transition:.3s;
}

.btn-primary:hover{
    background:#d4af37;
    color:#fff;
}

.btn-secondary{
    border:2px solid #fff;
    color:#fff;
}

/* PRESIDENT SECTION */

.president-section{
    padding:100px 0;
}

.president-grid{
    display:grid;
    grid-template-columns:350px 1fr;
    gap:60px;
    align-items:center;
}

.president-image img{
    width:100%;
    border-radius:25px;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
}

.president-label{
    color:#d4af37;
    font-weight:600;
    letter-spacing:3px;
}

.president-content h2{
    font-size:40px;
    margin:15px 0 30px;
}

.president-content p{
    font-size:18px;
    line-height:1.9;
    color:#555;
    margin-bottom:20px;
}

.president-content h3{
    margin-top:40px;
    font-size:24px;
}

.president-content span{
    color:#777;
}

/* ================= BOARD OF DIRECTORS ================= */

.bod-section{
    padding:90px 0;
}

.bod-header{
    text-align:center;
    margin-bottom:50px;
}

.bod-subtitle{
    color:#d4af37;
    font-weight:600;
    letter-spacing:2px;
    text-transform:uppercase;
    font-size:14px;
    display:block;
    margin-bottom:10px;
}

.bod-grid{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:30px;
}

.bod-card{
    border-radius:24px;
    padding:35px 25px;
    text-align:center;
    transition:.35s ease;
    position:relative;
}


.bod-avatar{
    width:100%;
    max-width:340px;
    height:440px;
    margin:0 auto 22px;
    border-radius:16px;
    color:#d4af37;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:42px;
    font-weight:700;
    overflow:hidden;
}

.bod-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.bod-role{
    display:inline-block;
    color:#d4af37;
    font-size:12px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:1.5px;
    margin-bottom:8px;
    background:rgba(212,175,55,.1);
    padding:4px 12px;
    border-radius:20px;
}

.bod-card h3{
    font-size:20px;
    color:#111;
    margin-bottom:8px;
    font-weight:600;
}

.bod-batch{
    display:inline-block;
    padding:4px 14px;
    background:#eef0f2;
    color:#555;
    border-radius:50px;
    font-size:13px;
    font-weight:500;
}

/* STATS */

.stats{
    background:#f5f5f5;
    padding:70px 0;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:30px;
}

.stat-card{
    text-align:center;
    background:#fff;
    padding:30px;
    border-radius:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.03);
}

.stat-card h2{
    font-size:45px;
    color:#111;
}

.stat-card p{
    color:#666;
}

/* SECTION GLOBAL */

section{
    padding:80px 0;
}

.section-title{
    font-size:36px;
    margin-bottom:40px;
    color:#111;
}

/* LATEST UPDATES */

.updates-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:30px;
}

.card{
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.card img{
    width:100%;
    height:250px;
    object-fit:cover;
}

.card-content{
    padding:25px;
}

.card-content h3{
    margin-bottom:15px;
    font-size:20px;
}

.card-content p{
    color:#555;
    line-height:1.7;
    font-size:14px;
}

/* LEGACY */

.legacy{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:50px;
    align-items:center;
}

.legacy img{
    width:100%;
    border-radius:20px;
}

.legacy p{
    font-size:16px;
    line-height:1.9;
    color:#555;
}

/* GALLERY */

.gallery-grid{
    display:grid;
    grid-template-columns:2fr 1fr 1fr;
    grid-template-rows:300px 300px;
    gap:20px;
}

.gallery-grid img{
    width:100%;
    height:100%;
    object-fit:cover;
    border-radius:25px;
    transition:.4s;
}

.gallery-grid img:hover{
    transform:scale(1.03);
}

.gallery-grid img:first-child{
    grid-row:span 2;
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

/* ANNOUNCEMENT MODAL */

.announcement-modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.82);
    backdrop-filter:blur(8px);
    display:flex;
    justify-content:center;
    align-items:center;
    z-index:99999;
}

.announcement-card{
    width:90%;
    max-width:820px;
    background:#111;
    color:white;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 30px 80px rgba(0,0,0,.45);
    animation:popup .45s ease;
    position:relative;
}

.announcement-header{
    background:linear-gradient(90deg,#111,#1c1c1c);
    padding:20px 30px;
    display:flex;
    align-items:center;
    gap:18px;
}

.announcement-header img{
    width:55px;
    height:55px;
    border-radius:50%;
}

.announcement-header span{
    color:#d4af37;
    font-weight:600;
    letter-spacing:2px;
}

.announcement-body{
    display:grid;
    grid-template-columns:330px 1fr;
}

.announcement-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.announcement-content{
    padding:45px;
}

.announcement-content small{
    color:#d4af37;
    letter-spacing:2px;
    font-weight:600;
}

.announcement-content h2{
    margin:15px 0;
    font-size:36px;
}

.announcement-content p{
    color:#ccc;
    line-height:1.9;
    margin-bottom:35px;
}

.announcement-btn{
    display:inline-block;
    padding:14px 35px;
    background:#d4af37;
    color:#111;
    border-radius:50px;
    text-decoration:none;
    font-weight:700;
    transition:.3s;
}

.announcement-btn:hover{
    background:white;
    transform:translateY(-2px);
}

.close-announcement{
    position:absolute;
    right:18px;
    top:18px;
    width:40px;
    height:40px;
    border:none;
    border-radius:50%;
    background:#d4af37;
    color:#111;
    font-size:24px;
    cursor:pointer;
    transition:.3s;
}

.close-announcement:hover{
    transform:rotate(90deg);
}

@keyframes popup{
from{
    opacity:0;
    transform:translateY(40px) scale(.9);
}
to{
    opacity:1;
    transform:translateY(0) scale(1);
}
}

/* RESPONSIVE */

@media(max-width:900px){
    .bod-grid{
        grid-template-columns:repeat(2, 1fr);
    }
    .gallery-grid{
        grid-template-columns:1fr;
    }
    .president-grid{
        grid-template-columns:1fr;
    }
    .hero-content h1{
        font-size:42px;
    }
    .hero-content p{
        font-size:18px;
    }
    .stats-grid,
    .updates-grid,
    .legacy,
    .footer-grid{
        grid-template-columns:1fr;
    }
    .nav-links{
        display:none;
    }
}

@media(max-width:600px){
    .bod-grid{
        grid-template-columns:1fr;
    }
    .announcement-body{
        grid-template-columns:1fr;
    }
    .announcement-image img{
        height:240px;
    }
    .announcement-content{
        padding:25px;
    }
    .announcement-content h2{
        font-size:24px;
    }
}

.nav-login-btn{
    background:#d4af37;
    color:#111 !important;
    padding:8px 20px;
    border-radius:30px;
    font-weight:600 !important;
    display:inline-flex;
    align-items:center;
    gap:8px;
    transition:.3s ease;
}

.nav-login-btn:hover{
    background:#fff;
    color:#111 !important;
    transform:translateY(-2px);
    box-shadow:0 4px 12px rgba(212,175,55,.3);
}

.nav-login-btn::after{
    display:none !important;
}
</style>
</head>

<body>

<div id="announcementModal" class="announcement-modal">
    <div class="announcement-card">
        <button class="close-announcement">&times;</button>
        <div class="announcement-header">
            <img src="{{ asset('images/Barons Logo.png') }}" alt="Barons Society Logo" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
            <span>OFFICIAL ANNOUNCEMENT</span>
        </div>

        <div class="announcement-body">
            <div class="announcement-image">
                <img src="{{ asset('images/cap.jpg') }}" alt="Barons Cap" onerror="this.src='https://placehold.co/400x500/1c1c1c/d4af37?text=Barons+Cap'">
            </div>
            <div class="announcement-content">
                <small>NEW OFFICIAL MERCHANDISE</small>
                <h2>Official Barons Society Cap</h2>
                <p>
                    Wear the newest official Barons Society Cap during meetings, outreach activities, reunions and official events.
                    Represent our brotherhood with pride, discipline, and unity wherever you go. Limited stocks available.
                </p>
                <a href="#" class="announcement-btn">Avail Now</a>
            </div>
        </div>
    </div>
</div>

<nav>
    <div class="nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{asset('images/Barons Logo.png')}}" alt="Barons Society Logo" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
            <span>Barons Society Incorporated</span>
        </a>

        <div class="nav-links">
            <a href="{{ url('/') }}" class="active">Home</a>
            <a href="{{ url('/classes') }}">Classes</a>
            <a href="{{ url('/login') }}" class="nav-login-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Member Login
            </a>
        </div>
    </div>
</nav>

<section id="home-section" class="hero">
    <div class="container">
        <div class="hero-content" data-aos="fade-right">
            <h1>
                Barons Society<br>
                <span>ROTC Alumni Incorporated</span>
            </h1>

            <div class="hero-line"></div>

            <p>
                A distinguished brotherhood of ROTC alumni committed to upholding
                the values of leadership, discipline, patriotism, and service to
                the community and the nation.
            </p>

            <div class="hero-buttons">
                <a href="#president-section" class="btn btn-primary">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</section>

<section id="president-section" class="president-section">
    <div class="container">
        <div class="president-grid">
            <div class="president-image" data-aos="fade-right">
                <img src="{{ asset('images/president.jpg') }}" alt="President Arnold Tobias" onerror="this.src='https://placehold.co/400x500/111/d4af37?text=President'">
            </div>

            <div class="president-content" data-aos="fade-left">
                <span class="president-label">PRESIDENT'S MESSAGE</span>
                <h2>Message from the President</h2>

                <p>
                    Welcome to the official website of the Barons Society ROTC Alumni
                    Incorporated. As we continue to uphold our legacy of brotherhood,
                    leadership, and service, let us remain united in our commitment
                    to nation-building and community development.
                </p>

                <p>
                    Through our collective efforts, may we inspire future generations,
                    strengthen our bonds of camaraderie, and continue serving with
                    honor, integrity, and purpose.
                </p>

                <h3>ARNOLD RAMIREZ TOBIAS</h3>
                <span>President, Barons Society ROTC Alumni Incorporated</span>
            </div>
        </div>
    </div>
</section>


<section id="stats-section" class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up">
                <h2>35+</h2>
                <p>Years of Service</p>
            </div>

            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <h2>500+</h2>
                <p>Members</p>
            </div>

            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <h2>100+</h2>
                <p>Community Activities</p>
            </div>

            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <h2>25+</h2>
                <p>Major Accomplishments</p>
            </div>
        </div>
    </div>
</section>

<section id="latest-section">
    <div class="container">
        <h2 class="section-title">Latest Updates</h2>

        <div class="updates-grid">
            <div class="card" data-aos="fade-up">
                <img src="{{ asset('images/anniversary.jpg') }}" alt="Anniversary" onerror="this.src='https://placehold.co/400x250/111/d4af37?text=Anniversary'">
                <div class="card-content">
                    <h3>Annual Fellowship & 36th Anniversary Celebration</h3>
                    <p>
                        On December 29, 2025, members of the Barons Society ROTC Alumni Inc.
                        gathered at the 4ID Officer's Clubhouse to celebrate their Annual
                        Fellowship with the theme, <em>"Celebrating 36 years of unity of the spirit and the bond of peace."</em>
                        The event featured the oath-taking of newly accepted members,
                        induction of officers for CY 2026–2027, and reaffirmed the society's
                        commitment to the ROTC Program and service to the nation.
                    </p>
                </div>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('images/com-outreach.jpg') }}" alt="Outreach" onerror="this.src='https://placehold.co/400x250/111/d4af37?text=Outreach'">
                <div class="card-content">
                    <h3>Paskong Pinoy Community Outreach Program</h3>
                    <p>
                        On December 18, 2025, Barons Society ROTC Alumni Inc. participated in
                        the <em>"Paskong Pinoy: Kids' Activities, Share A Toy Program and Mini
                        Playroom Launching"</em> at Oro Kalandang Peace Center, Sitio Tambo,
                        Brgy. Dansolihon, Cagayan de Oro City. Together with partner organizations,
                        the activity highlighted the true essence of service by bringing joy to children.
                    </p>
                </div>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('images/recognition.jpg') }}" alt="Independence Day" onerror="this.src='https://placehold.co/400x250/111/d4af37?text=Independence+Day'">
                <div class="card-content">
                    <h3>128th Philippine Independence Day Celebration</h3>
                    <p>
                        In honor of the 128th Philippine Independence Day, the Barons Society
                        ROTC Alumni Inc. participated in the celebration at Kiosko Kagawasan,
                        Divisoria Plaza, Cagayan de Oro City. The event featured the Philippine
                        Flag Caravan, military honors, interfaith prayers, and a wreath-laying ceremony.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="bod-section" class="bod-section">
    <div class="container">
        <div class="bod-header" data-aos="fade-up">
            <h2 class="section-title" style="margin-bottom: 10px;">Board of Directors & Officers</h2>
            <p style="color:#666; max-width:600px; margin:auto;">
                Guiding the Barons Society with dedicated service, military-civilian discipline, and visionary leadership.
            </p>
        </div>

        <div class="bod-grid">
            <!-- President -->
            <div class="bod-card" data-aos="fade-up" data-aos-delay="50">
                <div class="bod-avatar">
                    <img src="{{ asset('images/bod1.png') }}" alt="Arnold Ramirez Tobias" onerror="this.src='https://placehold.co/400x400/111/d4af37?text=Arnold+Tobias'">
                </div>
                <span class="bod-role">President</span>
                <h3>Arnold Ramirez Tobias</h3>
                <span class="bod-batch">Batch 1987</span>
            </div>

            <!-- Vice President -->
            <div class="bod-card" data-aos="fade-up" data-aos-delay="100">
                <div class="bod-avatar">
                    <img src="{{ asset('images/bod2.png') }}" alt="Rex Esparcia Salico" onerror="this.src='https://placehold.co/400x400/111/d4af37?text=Rex+Salico'">
                </div>
                <span class="bod-role">Vice-President</span>
                <h3>Renie Senagonia</h3>
                <span class="bod-batch">Batch 2010</span>
            </div>

            <!-- Secretary -->
            <div class="bod-card" data-aos="fade-up" data-aos-delay="150">
                <div class="bod-avatar">
                    <img src="{{ asset('images/bod3.png') }}" alt="Marichu Codilla Lucaban" onerror="this.src='https://placehold.co/400x400/111/d4af37?text=Marichu+Lucaban'">
                </div>
                <span class="bod-role">Secretary</span>
                <h3>Jover Magto</h3>
                <span class="bod-batch">Batch 2009</span>
            </div>

            <!-- Treasurer -->
            <div class="bod-card" data-aos="fade-up" data-aos-delay="200">
                <div class="bod-avatar">
                    <img src="{{ asset('images/bod4.png') }}" alt="Jean Licot Oray" onerror="this.src='https://placehold.co/400x400/111/d4af37?text=Jean+Oray'">
                </div>
                <span class="bod-role">Treasurer</span>
                <h3>Ricky Bagui</h3>
                <span class="bod-batch">Batch 1996</span>
            </div>

            <!-- Auditor -->
            <div class="bod-card" data-aos="fade-up" data-aos-delay="250">
                <div class="bod-avatar">
                    <img src="{{ asset('images/auditor.png') }}">
                </div>
                <span class="bod-role">Auditor</span>
                <h3>Danilo Caballero Raboy</h3>
                <span class="bod-batch">Batch 1995</span>
            </div>

            <!-- PIO -->
            <div class="bod-card" data-aos="fade-up" data-aos-delay="300">
                <div class="bod-avatar">
                    <img src="{{ asset('images/bod6.png') }}" alt="Nelton Saligan Pacudan" onerror="this.src='https://placehold.co/400x400/111/d4af37?text=Nelton+Pacudan'">
                </div>
                <span class="bod-role">PIO</span>
                <h3>Manuel Estanilla</h3>
                <span class="bod-batch">Batch 1992</span>
            </div>
        </div>
    </div>
</section>


<section id="legacy-section">
    <div class="container">
        <h2 class="section-title">The Barons Legacy</h2>

        <div class="legacy" data-aos="fade-up">
            <img src="{{asset('images/legacy.jpg')}}" alt="Legacy" onerror="this.src='https://placehold.co/500x350/111/d4af37?text=Barons+Legacy'">

            <div>
                <p>
                    The Barons Society ROTC Alumni Incorporated is a brotherhood founded on the principles of leadership, discipline, 
                    service, and camaraderie. For decades, the organization has brought together ROTC alumni who share a common commitment 
                    to personal excellence, community development, and nation-building.
                </p>
                <p style="margin-top: 15px;">
                    Through meaningful programs, fellowship, and service initiatives, the Barons continue to preserve their rich 
                    heritage while inspiring future generations to lead with integrity, honor, and purpose.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="gallery-section" class="gallery-section">
    <div class="container">
        <h2 class="section-title">Barons Gallery</h2>

        <div class="gallery-grid">
            <img src="{{ asset('images/annual.jpg') }}" data-aos="fade-up" alt="Annual Gathering" onerror="this.src='https://placehold.co/600x600/111/d4af37?text=Gallery+1'">
            <img src="{{ asset('images/2.jpg') }}" data-aos="fade-up" data-aos-delay="100" alt="Event 2" onerror="this.src='https://placehold.co/300x300/111/d4af37?text=Gallery+2'">
            <img src="{{ asset('images/3.jpg') }}" data-aos="fade-up" data-aos-delay="200" alt="Event 3" onerror="this.src='https://placehold.co/300x300/111/d4af37?text=Gallery+3'">
            <img src="{{ asset('images/4.jpg') }}" data-aos="fade-up" data-aos-delay="300" alt="Event 4" onerror="this.src='https://placehold.co/300x300/111/d4af37?text=Gallery+4'">
            <img src="{{ asset('images/5.jpg') }}" data-aos="fade-up" data-aos-delay="400" alt="Event 5" onerror="this.src='https://placehold.co/300x300/111/d4af37?text=Gallery+5'">
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- About -->
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="{{ asset('images/Barons Logo.png') }}" alt="Barons Logo" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
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
            © {{ date('Y') }} Barons Society ROTC Alumni Incorporated. SEC No. 2022080064500-05. All Rights Reserved.
        </div>
    </div>
</footer>

<script>
const modal = document.getElementById("announcementModal");
const closeBtn = document.querySelector(".close-announcement");

// Show only once per browser session
if(sessionStorage.getItem("baronsAnnouncement") === "shown"){
    modal.style.display = "none";
}else{
    sessionStorage.setItem("baronsAnnouncement","shown");
}

closeBtn.addEventListener("click",function(){
    modal.style.display = "none";
});

window.addEventListener("click",function(e){
    if(e.target === modal){
        modal.style.display = "none";
    }
});
</script>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({
    duration: 1000,
    easing: 'ease-in-out',
    once: true,
    offset: 120
});
</script>

</body>
</html>