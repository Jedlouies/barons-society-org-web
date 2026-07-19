<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barons Society | Updates</title>

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
<a href="{{ url('/blogs') }}" class="active">News and Updates</a>
<a href="{{ url('/classes') }}">Classes</a>
<a href="#">Bylaws</a>
</div>

</div>

</nav>

<section class="hero">

<div class="container hero-content">

<h1>Latest News & Updates</h1>

<p>
Stay informed with the latest announcements, community outreach,
anniversary celebrations, recognition programs, and activities of
the Barons Society ROTC Alumni Incorporated.
</p>

</div>

</section>

<section class="blog-section">

<div class="container">

    @if(isset($announcements) && count($announcements) > 0)

        <div class="blog-grid">

            @foreach($announcements as $announcement)

                <div class="blog-card">

                    <img src="{{ $announcement['image'] ?: asset('images/default-news.jpg') }}">

                    <div class="blog-content">

                        <div class="blog-date">
                            {{ \Carbon\Carbon::parse($announcement['created_at'])->format('F d, Y') }}
                        </div>

                        <h2>{{ $announcement['title'] }}</h2>

                        <p>
                            {{ Str::limit($announcement['description'],120) }}
                        </p>

                        @if($announcement['button_link'])

                            <a
                                href="{{ $announcement['button_link'] }}"
                                class="read-btn">

                                {{ $announcement['button_text'] ?: 'Learn More' }}

                            </a>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    @endif


    <div class="blog-grid">

        @forelse($news as $article)

            <div class="blog-card">

                <img src="{{ $article['cover_image'] ?: asset('images/default-news.jpg') }}">

                <div class="blog-content">

                    <div class="blog-date">
                        {{ \Carbon\Carbon::parse($article['published_date'])->format('F d, Y') }}
                    </div>

                    <h2>
                        {{ $article['title'] }}
                    </h2>

                    <p>
                        {{ $article['summary'] }}
                    </p>

                    <a
                        href="{{ route('news.show',$article['slug']) }}"
                        class="read-btn">

                        Read More

                    </a>

                </div>

            </div>

        @empty

            <p>No news available.</p>

        @endforelse

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