<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Barons Society | Classes</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="https://barons-society.onrender.com/images/Barons%20Logo.png" type="image/png">


<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
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

/* ACCORDION */

/* ===========================
   CLASSES SECTION
=========================== */

.classes{
    padding:60px 0;
}

.class-card{
    background:#fff;
    border-radius:14px;
    margin-bottom:18px;
    border:1px solid #ececec;
    box-shadow:0 8px 18px rgba(0,0,0,.08);
    overflow:hidden;
}

/* Entire row */

.class-row{
    display:grid;
    grid-template-columns:80px 2fr 1.5fr 1fr 1fr auto;
    align-items:center;
    gap:20px;
    padding:20px 25px;
}

/* Left */

.class-info{
    display:flex;
    flex-direction:column;
}

.class-number{
    font-size:26px;
    font-weight:700;
    color:#111;
}

.class-name{
    color:#d4af37;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:1px;
    margin-top:3px;
}

/* Summary */

.summary-item{
    display:flex;
    flex-direction:column;
}

.summary-item .label{
    font-size:11px;
    text-transform:uppercase;
    color:#999;
    margin-bottom:5px;
    letter-spacing:1px;
}

.summary-item strong{
    font-size:15px;
    color:#111;
    font-weight:600;
}

/* Button */

.button-area{
    display:flex;
    justify-content:flex-end;
}

.view-btn{
    background:#111;
    color:#fff;
    border:none;
    padding:10px 22px;
    border-radius:30px;
    cursor:pointer;
    transition:.3s;
    font-size:14px;
    font-weight:600;
}

.view-btn:hover{
    background:#d4af37;
    color:#111;
}

/* Members */

.class-content{
    display:none;
    border-top:1px solid #eee;
    padding:25px;
}

.class-content.active{
    display:block;
}

.members-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.members-header h3{
    font-size:18px;
}

.members-header span{
    color:#666;
    font-size:14px;
}

.members-list ol{
    columns:2;
    column-gap:60px;
    padding-left:20px;
}

.members-list li{
    margin-bottom:8px;
    line-height:1.6;
    color:#444;
}

.members-list li::marker{
    color:#d4af37;
    font-weight:bold;
}

.class-logo{
    display:flex;
    justify-content:center;
    align-items:center;
}

.class-logo img{
    width:65px;
    height:65px;
    object-fit:cover;
}

/* Responsive */

@media(max-width:1000px){

    .class-row{
        grid-template-columns:1fr;
        gap:15px;
    }

    .button-area{
        justify-content:flex-start;
    }

    .members-list ol{
        columns:1;
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

</style>

</head>

<body>

<nav>

<div class="container nav-container">

<div class="logo">
<img src="{{ asset('images/Barons Logo.png') }}">
Barons Society Incorporated
</div>

<div class="nav-links">
<a href="{{ url('/') }}">Home</a>
<a href="{{ url('/blogs') }}" >News and Updates</a>
<a href="{{ url('/classes') }}" class="active">Classes</a>
<a href="{{ url('/bylaws') }}">Bylaws</a>
</div>

</div>

</nav>

<section class="hero">

<div class="container hero-content">

<h1>Barons Classes</h1>

<p>
The Barons Society has a rich history of classes that have contributed to the growth and development of the organization. Each class represents a unique group of individuals who have come together to make a difference in their communities and beyond. Explore the various classes below to learn more about their members, achievements, and impact on the Barons Society.
</p>

</div>

</section>

<section class="classes">

<div class="container">

@foreach($classes as $class)

<div class="class-card">

<div class="class-row">

    <!-- Class Logo -->
    <div class="class-logo">

        @if(!empty($class['class_logo']))
            <img src="{{ $class['class_logo'] }}" alt="{{ $class['class_name'] }}">
        @else
            <img src="{{ asset('images/default-class-logo.png') }}" alt="Default Logo">
        @endif

    </div>

    <!-- Class -->
    <div class="class-info">

        <div class="class-number">
            Class {{ $class['class_number'] }}
        </div>

        <div class="class-name">
            {{ $class['class_name'] }}
        </div>

    </div>

    <!-- Corps Commander -->
    <div class="summary-item">
        <span class="label">Corps Commander</span>
        <strong>{{ $class['corps_commander'] }}</strong>
    </div>

    <!-- Members -->
    <div class="summary-item">
        <span class="label">Members</span>
        <strong>{{ count($class['members']) }} Alumni</strong>
    </div>

    <!-- Batch -->
    <div class="summary-item">
        <span class="label">Batch</span>
        <strong>{{ $class['batch_year'] }}</strong>
    </div>

    <!-- Button -->
    <div class="button-area">
        <button class="view-btn">
            View Members ▼
        </button>
    </div>

</div>
    <div class="class-content">

        <div class="members-list">

            <div class="members-header">
                <h3>Class Members</h3>
                <span>{{ count($class['members']) }} Alumni</span>
            </div>

            <ol>

                @foreach($class['members'] as $member)

                <li>
                    {{ $member['last_name'] }},
                    {{ $member['first_name'] }}

                    @if(!empty($member['middle_name']))
                        {{ strtoupper(substr($member['middle_name'],0,1)) }}.
                    @endif

                    @if(!empty($member['suffix']))
                        {{ $member['suffix'] }}
                    @endif
                </li>

                @endforeach

            </ol>

        </div>

    </div>

</div>

@endforeach

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
            © {{ date('Y') }} Barons Society ROTC Alumni Incorporated. SEC No. 2022080064500-05.
            All Rights Reserved.
        </div>

    </div>

</footer>


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
</script>



</body>
</html>