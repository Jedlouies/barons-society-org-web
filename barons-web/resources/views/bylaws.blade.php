<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barons Society | Bylaws</title>

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
    background:#f7f7f7;
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
    height:350px;
    background:
    linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('{{ asset("images/blog-background.jpg") }}');
    background-size:cover;
    background-position:center;
    display:flex;
    align-items:center;
}

.hero-content{
    color:white;
}

.hero-content h1{
    font-size:55px;
    margin-bottom:15px;
}

.hero-content p{
    max-width:700px;
    font-size:18px;
    color:#ddd;
}

/* BLOGS */

.blog-section{
    padding:80px 0;
}

.blog-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:35px;
}

.blog-card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.35s;
}

.blog-card:hover{
    transform:translateY(-8px);
}

.blog-card img{
    width:100%;
    height:230px;
    object-fit:cover;
}

.blog-content{
    padding:25px;
}

.blog-date{
    color:#999;
    font-size:14px;
    margin-bottom:10px;
}

.blog-content h2{
    font-size:23px;
    margin-bottom:15px;
}

.blog-content p{
    color:#555;
    line-height:1.7;
}

.read-btn{
    display:inline-block;
    margin-top:20px;
    padding:12px 22px;
    background:#111;
    color:white;
    text-decoration:none;
    border-radius:8px;
    transition:.3s;
}

.read-btn:hover{
    background:#d4af37;
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

/* ===========================
BYLAWS
=========================== */

.bylaws-section{
    padding:70px 0;
}

.bylaws-wrapper{
    background:#fff;
    border-radius:16px;
    padding:50px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.document-header{
    text-align:center;
    margin-bottom:40px;
    border-bottom:2px solid #f1f1f1;
    padding-bottom:25px;
}

.document-header h2{
    font-size:34px;
    color:#111;
}

.document-header p{
    margin-top:8px;
    color:#777;
    font-size:17px;
}

.notice-box{
    background:#fff9e8;
    border-left:5px solid #d4af37;
    padding:20px;
    border-radius:8px;
    margin-bottom:40px;
}

.notice-box strong{
    display:block;
    margin-bottom:10px;
    color:#111;
}

.notice-box p{
    color:#555;
    line-height:1.8;
}

.toc{
    background:#fafafa;
    border:1px solid #ececec;
    border-radius:10px;
    padding:25px;
    margin-bottom:45px;
}

.toc h3{
    margin-bottom:15px;
    color:#111;
}

.toc ul{
    list-style:none;
}

.toc li{
    margin-bottom:12px;
}

.toc a{
    text-decoration:none;
    color:#444;
    transition:.3s;
}

.toc a:hover{
    color:#d4af37;
    padding-left:6px;
}

.article{
    margin-bottom:50px;
}

.article h3{
    display:inline-block;
    background:#111;
    color:#fff;
    padding:8px 18px;
    border-radius:30px;
    font-size:15px;
    margin-bottom:15px;
}

.article h4{
    margin-bottom:15px;
    font-size:28px;
    color:#111;
}

.article p{
    color:#555;
    line-height:2;
    text-align:justify;
}

.article ul{
    margin-top:15px;
    padding-left:25px;
}

.article li{
    margin-bottom:10px;
    line-height:1.8;
}

html{
    scroll-behavior:smooth;
}

@media(max-width:768px){

.bylaws-wrapper{
    padding:25px;
}

.document-header h2{
    font-size:26px;
}

.article h4{
    font-size:22px;
}

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

@media(max-width:900px){

.blog-grid{
grid-template-columns:1fr;
}

.hero h1{
font-size:40px;
}

.nav-links{
display:none;
}

}

</style>

</head>
<body>

<nav>

<div class="container nav-container">

<div class="logo">
<img src="{{ asset('images/Barons Logo.png') }}">
<span>Barons Society Incorporated</span>
</div>

<div class="nav-links">
<a href="{{ url('/') }}">Home</a>
<a href="{{ url('/blogs') }}" >News and Updates</a>
<a href="{{ url('/classes') }}">Classes</a>
<a href="{{ url('/bylaws') }}" class="active">Bylaws</a>
</div>

</div>

</nav>

<section class="hero">

<div class="container hero-content">

<h1>Bylaws</h1>

<p>
    The Barons Society ROTC Alumni Incorporated is governed by a set of bylaws that outline the organization's structure, purpose, and operational guidelines. These bylaws serve as a framework for decision-making, membership rights and responsibilities, and the overall functioning of the society. They are designed to ensure transparency, accountability, and effective governance within the organization.
</p>

</div>

</section>
<section class="bylaws-section">

<div class="container">

<div class="bylaws-wrapper">

<div class="document-header">

<h2>
Barons Society ROTC Alumni Incorporated
</h2>

<p>
Constitution and By-Laws
</p>

</div>

<div class="notice-box">

<strong>Notice</strong>

<p>
This page contains the public version of the Constitution and By-Laws of the
Barons Society ROTC Alumni Incorporated. It is intended to guide members and
visitors regarding the organization's principles, governance, and membership.
</p>

</div>

<div class="toc">

<h3>Contents</h3>

<ul>

<li><a href="#article1">Article I — Name</a></li>

<li><a href="#article2">Article II — Vision & Mission</a></li>

<li><a href="#article3">Article III — Objectives</a></li>

<li><a href="#article4">Article IV — Membership</a></li>

<li><a href="#article5">Article V — Officers</a></li>

<li><a href="#article6">Article VI — Meetings</a></li>

<li><a href="#article7">Article VII — Amendments</a></li>

</ul>

</div>


<div class="article" id="article1">

<h3>Article I</h3>

<h4>Name</h4>

<p>

Place the contents of Article I here.

</p>

</div>


<div class="article" id="article2">

<h3>Article II</h3>

<h4>Vision & Mission</h4>

<p>

Place the contents of Article II here.

</p>

</div>


<div class="article" id="article3">

<h3>Article III</h3>

<h4>Objectives</h4>

<p>

Place the contents of Article III here.

</p>

</div>


<div class="article" id="article4">

<h3>Article IV</h3>

<h4>Membership</h4>

<p>

Place the contents here.

</p>

</div>


<div class="article" id="article5">

<h3>Article V</h3>

<h4>Officers</h4>

<p>

Place the contents here.

</p>

</div>


<div class="article" id="article6">

<h3>Article VI</h3>

<h4>Meetings</h4>

<p>

Place the contents here.

</p>

</div>


<div class="article" id="article7">

<h3>Article VII</h3>

<h4>Amendments</h4>

<p>

Place the contents here.

</p>

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