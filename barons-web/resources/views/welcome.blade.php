<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barons Society | Home</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/BaronsLogo.png') }}" type="image/png">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>


<nav>
    <div class="nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{asset('images/BaronsLogo.png')}}" alt="Barons Society Logo" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
            <span>Barons Society Incorporated</span>
        </a>

        <div class="nav-links">
            <a href="{{ url('/') }}" class="active">Home</a>
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
                    <img src="{{ asset('images/BaronsLogo.png') }}" alt="Barons Logo" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
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