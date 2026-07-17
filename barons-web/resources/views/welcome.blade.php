<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barons Society</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{asset('images/Barons Logo.png')}}" type="image/png">

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

/* NAVBAR */

nav{
    background:#111;
    padding:20px 0;
    position:sticky;
    top:0;
    z-index:1000;
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
    color:#fff;
    font-size:22px;
    font-weight:600;
}

.nav-links{
    display:flex;
    gap:30px;
}

.nav-links a{
    color:#fff;
    text-decoration:none;
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
    max-width:700px;
}

.hero-content h1{
    font-size:60px;
    margin-bottom:20px;
}

.hero-content p{
    font-size:20px;
    line-height:1.8;
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
}

.btn-secondary{
    border:2px solid #fff;
    color:#fff;
}

/* STATS */

.stats{
    background:#fff;
    padding:70px 0;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:30px;
}

.stat-card{
    text-align:center;
}

.stat-card h2{
    font-size:45px;
    color:#111;
}

.stat-card p{
    color:#666;
}

/* SECTION */

section{
    padding:80px 0;
}

.section-title{
    font-size:36px;
    margin-bottom:40px;
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

/* MISSION VISION */

.mv-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:40px;
}

.mv-card{
    background:#fff;
    padding:40px;
    border-radius:20px;
}

/* ACCOMPLISHMENTS */

.timeline{
    display:flex;
    justify-content:center;
    gap:20px;
    margin-bottom:40px;
}

.timeline button{
    padding:10px 20px;
}

/* EVENTS */

.events-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:30px;
}

/* GALLERY */

.gallery-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

.gallery-grid img{
    width:100%;
    border-radius:20px;
}

/* FOOTER */

.footer{
    background:#111;
    color:#fff;
    padding:80px 0 30px;
}

.footer-grid{
    display:grid;
    grid-template-columns:2fr 1fr 1fr;
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

.footer-links,
.footer-contact{
    display:flex;
    flex-direction:column;
}

.footer-links h3,
.footer-contact h3{
    margin-bottom:25px;
    color:#d4af37;
}

.footer-links a{
    color:#bbb;
    text-decoration:none;
    margin-bottom:12px;
    transition:.3s;
}

.footer-links a:hover{
    color:#d4af37;
    padding-left:8px;
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

@media(max-width:900px){

    .footer-grid{
        grid-template-columns:1fr;
        gap:40px;
    }

    .footer-logo{
        flex-direction:column;
        text-align:center;
    }
}
.logo{
    display: flex;
    align-items: center;
    gap: 12px;
    color: white;
    font-size: 20px;
    font-weight: 600;
}

.logo img{
    width: 45px;
    height: 45px;
    border-radius: 50%; 
    object-fit: cover;
}

.card-content .btn-read {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 18px;
    background: #000;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: 0.3s;
}

.card-content .btn-read:hover {
    background: #333;
}

.hero-content{
    max-width:800px;
    color:#fff;
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
}

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
}@media(max-width:900px){
    .gallery-grid{
        grid-template-columns:1fr;
    }

    .gallery-card,
    .gallery-card.large{
        height:300px;
    }
}

@media(max-width:900px){
    .president-grid{
        grid-template-columns:1fr;
    }
}

@media(max-width:900px){
    .hero-content h1{
        font-size:45px;
    }

    .hero-content p{
        font-size:18px;
    }
}

@media(max-width:900px){

    .hero-content h1{
        font-size:40px;
    }

    .stats-grid,
    .updates-grid,
    .events-grid,
    .gallery-grid,
    .legacy,
    .mv-grid,
    .footer-grid{
        grid-template-columns:1fr;
    }

    .nav-links{
        display:none;
    }
}
</style>
</head>

<body>

<nav>
    <div class="nav-container">
        <div class="logo">
            <img src="{{asset('images/Barons Logo.png')}}" alt="Barons Society Logo">
            Barons Society Incorporated
        </div>

        <div class="nav-links">
            <a href="#home-section">Home</a>
            <a href="#">Blogs</a>
            <a href="#">Events</a>
            <a href="#">Bylaws</a>
        </div>
    </div>
</nav>

<section id="home-section" class="hero">
    <div class="container">
        <div class="hero-content">


            <h1>
                Barons Society<br>
                <span>ROTC Alumni Incorporated</span>
            </h1>

        

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

            <div class="president-image">
                <img src="{{ asset('images/president.jpg') }}" alt="President">
            </div>

            <div class="president-content">

                <span class="president-label">
                    PRESIDENT'S MESSAGE
                </span>

                <h2>
                    Message from the President
                </h2>

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

                <h3>
                    ARNOLD RAMIREZ TOBIAS
                </h3>

                <span>
                    President, Barons Society ROTC Alumni Incorporated
                </span>

            </div>

        </div>

    </div>

</section>

<section id="stats-section" class="stats">
    <div class="container">
        <div class="stats-grid">

            <div class="stat-card">
                <h2>35+</h2>
                <p>Years of Service</p>
            </div>

            <div class="stat-card">
                <h2>500+</h2>
                <p>Members</p>
            </div>

            <div class="stat-card">
                <h2>100+</h2>
                <p>Community Activities</p>
            </div>

            <div class="stat-card">
                <h2>25+</h2>
                <p>Major Accomplishments</p>
            </div>

        </div>
    </div>
</section>

<section id="latest-section">
    <div class="container">
        <h2 class="section-title">
            Latest Updates
        </h2>

        <div class="updates-grid">

            <div class="card">
            <img src="{{ asset('images/anniversary.jpg') }}">
            <div class="card-content">
                <h3>Annual Fellowship & 36th Anniversary Celebration</h3>
                <p>
                    On December 29, 2025, members of the Barons Society ROTC Alumni Inc.
                    gathered at the 4ID Officer's Clubhouse to celebrate their Annual
                    Fellowship with the theme, <em>"Celebrating 36 years of unity of the spirit and the bond of peace."</em>
                    The event featured the oath-taking of newly accepted members,
                    induction of officers for CY 2026–2027, and reaffirmed the society's
                    commitment to the development of the ROTC Program, unity, camaraderie,
                    and service to the nation.
                </p>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('images/com-outreach.jpg') }}">
            <div class="card-content">
                <h3>Paskong Pinoy Community Outreach Program</h3>
                <p>
                    On December 18, 2025, Barons Society ROTC Alumni Inc. participated in
                    the <em>"Paskong Pinoy: Kids' Activities, Share A Toy Program and Mini
                    Playroom Launching"</em> at Oro Kalandang Peace Center, Sitio Tambo,
                    Brgy. Dansolihon, Cagayan de Oro City. Together with local government
                    agencies and partner organizations, the activity highlighted the true
                    essence of service by strengthening communities, fostering unity, and
                    bringing joy to children and families.
                </p>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('images/recognition.jpg') }}">
            <div class="card-content">
                <h3>128th Philippine Independence Day Celebration</h3>
                <p>
                    In honor of the 128th Philippine Independence Day, the Barons Society
                    ROTC Alumni Inc. participated in the celebration at Kiosko Kagawasan,
                    Divisoria Plaza, Cagayan de Oro City. The event featured the Philippine
                    Flag Caravan, military honors, interfaith prayers, cultural performances,
                    and a wreath-laying ceremony in remembrance of our national heroes.
                    This meaningful occasion reaffirmed the organization's commitment to
                    patriotism, unity, and dedicated service to the Filipino people.
                </p>
            </div>
        </div>

        </div>
    </div>
</section>

<section id="legacy-section">
    <div class="container">

        <h2 class="section-title">
            The Barons Legacy
        </h2>

        <div class="legacy">
            <img src="{{asset('images/legacy.jpg')}}">

            <div>
                <p>
                    The Barons Society ROTC Alumni Incorporated is a brotherhood founded on the principles of leadership, discipline, 
                    service, and camaraderie. For decades, the organization has brought together ROTC alumni who share a common commitment 
                    to personal excellence, community development, and nation-building.

                    Through meaningful programs, fellowship, and service initiatives, the Barons continue to preserve their rich 
                    heritage while inspiring future generations to lead with integrity, honor, and purpose.
                </p>
            </div>
        </div>

    </div>
</section>

<section id="gallery-section" class="gallery-section">
    <div class="container">

        <h2 class="section-title">
            Barons Gallery
        </h2>

        <div class="gallery-grid">
            <img src="{{ asset('images/annual.jpg') }}">
            <img src="{{ asset('images/2.jpg') }}">
            <img src="{{ asset('images/3.jpg') }}">
            <img src="{{ asset('images/4.jpg') }}">
            <img src="{{ asset('images/5.jpg') }}">
        </div>

    </div>
</section>

<footer>
<footer class="footer">

    <div class="container">

        <div class="footer-grid">

            <!-- About -->
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="{{ asset('images/Barons Logo.png') }}" alt="">
                    <h3>Barons Society<br>ROTC Alumni Incorporated</h3>
                </div>

                <p>
                    Building Brotherhood, Leadership, and Service through
                    unity, patriotism, and community engagement. Honoring our
                    legacy while inspiring future generations.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="footer-links">
                <h3>Quick Links</h3>

                <a href="#home-section">Home</a>
                <a href="#blogs-section">Blogs</a>
                <a href="#activities-section">Activities</a>
                <a href="#gallery-section">Gallery</a>
                <a href="#">Accomplishments</a>
                <a href="#">Contact</a>
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
            © {{ date('Y') }} Barons Society ROTC Alumni Incorporated.
            All Rights Reserved.
        </div>

    </div>

</footer>
</body>
</html>