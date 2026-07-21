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
    line-height:1.6;
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
BYLAWS SPECIFIC STYLING
=========================== */

.bylaws-section{
    padding:70px 0;
}

.bylaws-wrapper{
    border-radius:16px;
    padding:50px;
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
    font-weight: 700;
}

.document-header p{
    margin-top:8px;
    color:#d4af37;
    font-size:18px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* SEC Registration Box Details */
.sec-notice-box{
    background:#fafafa;
    border:1px solid #e5e5e5;
    padding:24px;
    border-radius:12px;
    margin-bottom:40px;
    display:flex;
    align-items:center;
    gap:24px;
}

.sec-logo-container {
    flex-shrink: 0;
}

.sec-badge-text h4 {
    font-size: 16px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px;
}

.sec-badge-text p {
    color: #555;
    font-size: 13px;
    line-height: 1.5;
}

.sec-meta {
    margin-top: 8px;
    font-size: 12px;
    color: #888;
    display: flex;
    gap: 15px;
    font-weight: 500;
}

.sec-meta span strong {
    color: #111;
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
    font-size: 18px;
    font-weight: 600;
}

.toc ul{
    list-style:none;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 10px;
}

.toc li{
    margin-bottom:0px;
}

.toc a{
    text-decoration:none;
    color:#555;
    font-weight: 500;
    font-size: 14px;
    transition:.3s;
}

.toc a:hover{
    color:#d4af37;
    padding-left:6px;
}

/* Elegant Bylaws Content Styling */
.article{
    margin-bottom:50px;
    border-bottom: 1px solid #f1f1f1;
    padding-bottom:40px;
}

.article:last-child {
    border-bottom: none;
    padding-bottom: 0px;
    margin-bottom: 0px;
}

.article h3{
    display:inline-block;
    background:#111;
    color:#fff;
    padding:6px 16px;
    border-radius:30px;
    font-size:13px;
    font-weight: 600;
    margin-bottom:15px;
    letter-spacing: 0.5px;
}

.article h4{
    margin-bottom:15px;
    font-size:24px;
    color:#111;
    font-weight: 600;
}

.article p{
    color:#555;
    font-size: 15px;
    line-height:1.8;
    text-align:justify;
    margin-bottom: 15px;
}

.article ul{
    margin-top:10px;
    margin-bottom: 15px;
    padding-left:20px;
    list-style-type: none;
}

.article li{
    margin-bottom:8px;
    line-height:1.7;
    font-size: 14px;
    color: #555;
    position: relative;
    padding-left: 15px;
}

.article li::before {
    content: "•";
    color: #d4af37;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
    position: absolute;
    left: 15px;
}

.definition-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 15px;
}

.definition-card {
    background: #fafafa;
    border-left: 3px solid #d4af37;
    padding: 15px;
    border-radius: 0 8px 8px 0;
}

.definition-card strong {
    display: block;
    color: #111;
    font-size: 14px;
    margin-bottom: 4px;
}

.definition-card p {
    margin-bottom: 0;
    font-size: 13.5px;
    text-align: left;
}

.founders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.founder-card {
    background: #fafafa;
    border: 1px solid #eaeaea;
    padding: 12px 15px;
    border-radius: 8px;
    font-size: 13px;
    color: #666;
}

.founder-card strong {
    color: #111;
    display: block;
    font-size: 14px;
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
    font-size:20px;
}

.sec-notice-box {
    flex-direction: column;
    text-align: center;
    gap: 15px;
}

.sec-meta {
    flex-direction: column;
    gap: 5px;
    align-items: center;
}

.definition-grid {
    grid-template-columns: 1fr;
    gap: 15px;
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
<img src="{{ asset('images/Barons Logo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
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

<h1>Constitution and Bylaws</h1>

<p>
    The Barons Society ROTC Alumni Incorporated is governed by official corporate guidelines registered with the Securities and Exchange Commission of the Philippines. These bylaws outline our administrative structure, fraternal duties, and commitment to leadership and service.
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

<!-- Minimalist SEC Compliance Notice with Custom SVG SEC Logo -->
<div class="sec-notice-box">
    <div class="sec-logo-container">
        <!-- Elegant, minimal representation of SEC logo -->
        <img src="{{ asset('images/sec-logo.png') }}" alt="SEC Logo" style="width: 60px; height: 60px; object-fit: contain;">
    </div>
    <div class="sec-badge-text">
        <h4>Securities & Exchange Commission Registered</h4>
        <p>
            Certified as a non-stock, non-profit organization under Republic Act No. 11232 (The Revised Corporation Code of the Philippines). This organization is legally restricted from soliciting public investments.
        </p>
        <div class="sec-meta">
            <span>REGISTRATION NO: <strong>2022080064500-05</strong></span>
            <span>DATE APPROVED: <strong>August 17, 2022</strong></span>
        </div>
    </div>
</div>

<div class="toc" id="toc">

<h3>Contents</h3>

<ul>

<li><a href="#toc">Article I — Name & Acronyms</a></li>

<li><a href="#article1">Article II — Vision & Mission</a></li>

<li><a href="#article2">Article III — Objectives</a></li>

<li><a href="#article3">Article IV — Meetings & Quorum</a></li>

<li><a href="#article4">Article V — Board of Trustees</a></li>

<li><a href="#article5">Article VI — Executive Officers</a></li>

<li><a href="#article6">Article VII — General Provisions</a></li>

</ul>

</div>

<!-- ARTICLE I -->
<div class="article" id="article1">

<h3>Article I</h3>

<h4>Name & Acronyms</h4>

<p>
    The official name of this organization is the <strong>BARONS SOCIETY ROTC ALUMNI INCORPORATED</strong>. The definitions of our governing terms are established as follows:
</p>

<div class="definition-grid">
    <div class="definition-card">
        <strong>ROTC</strong>
        <p>Reserved Officer Training Corps.</p>
    </div>
    <div class="definition-card">
        <strong>ALUMNI</strong>
        <p>A graduate or former cadet of the University of Science and Technology of the Philippines (USTP).</p>
    </div>
    <div class="definition-card">
        <strong>BARONS</strong>
        <p>Men and women who have pledged their lifelong loyalty, honor, and service to their superiors and their country.</p>
    </div>
    <div class="definition-card">
        <strong>SOCIETY</strong>
        <p>A structured organization established for dedicated civic, fraternal, and patriotic engagement.</p>
    </div>
</div>

</div>

<!-- ARTICLE II -->
<div class="article" id="article2">

<h3>Article II</h3>

<h4>Vision & Mission</h4>

<p>
    The Barons Society is committed to building brotherhood, high-character leadership, and civic service through solid unity, active patriotism, and community outreach. We strive to honor our rich military-civilian legacy while preparing and inspiring future generations of leaders.
</p>

</div>

<!-- ARTICLE III -->
<div class="article" id="article3">

<h3>Article III</h3>

<h4>Corporate Objectives</h4>

<p>
    Pursuant to its corporate charter, the primary purposes and objectives of the Society are:
</p>
<ul>
    <li>To nurture camaraderie, esprit de corps, mutual welfare, and lasting closeness among all registered members.</li>
    <li>To provide swift, benevolent financial assistance to members in times of major life milestones:
        <ul>
            <li><strong>Member Death:</strong> Accorded the absolute highest priority and rapid support.</li>
            <li><strong>Serious Illness:</strong> Providing supportive financial assistance during hospitalization.</li>
            <li><strong>Marriage:</strong> Commemorating and honoring the union of registered members.</li>
        </ul>
    </li>
    <li>To promote and uphold military-civilian decorum, proper etiquette, and disciplined behavior in all public functions.</li>
</ul>

</div>

<!-- ARTICLE IV -->
<div class="article" id="article4">

<h3>Article IV</h3>

<h4>Meetings & Quorum</h4>

<p>
    The coordination and assembly of the general membership are governed by the following guidelines:
</p>
<ul>
    <li><strong>Annual Meeting:</strong> The regular meeting of the members is held annually on <strong>December 25</strong>.</li>
    <li><strong>Meeting Notices:</strong> Official written notices must be transmitted to members at least <strong>21 days prior</strong> to regular meetings, and at least <strong>1 week prior</strong> for special meetings. Notice is valid via email or corporate messaging systems.</li>
    <li><strong>Quorum:</strong> A valid quorum consists of a <strong>simple majority</strong> of the active, registered membership.</li>
    <li><strong>Voting & Proxies:</strong> Members can vote in person or by signing a written proxy submitted to the Corporate Secretary. No proxy is valid for longer than five (5) consecutive years.</li>
</ul>

</div>

<!-- ARTICLE V -->
<div class="article" id="article5">

<h3>Article V</h3>

<h4>Board of Trustees</h4>

<p>
    The overall corporate powers, business operations, and asset management of the organization are vested in the Board of Trustees:
</p>
<ul>
    <li><strong>Composition & Term:</strong> The board consists of exactly <strong>seven (7) Trustees</strong>, elected from active membership for a term not exceeding three (3) years.</li>
    <li><strong>Board Meetings:</strong> Regular board sessions are held on a monthly basis. Special sessions require a 2-day notice. Trustees may participate and vote remotely through secure video-conferencing. <em>Trustee voting by proxy is strictly prohibited.</em></li>
    <li><strong>Disqualification:</strong> A member is disqualified from being a Trustee if convicted of an offense carrying a prison term exceeding six (6) years, found administratively liable for fraud, or penalized by a regulatory authority within five (5) years prior.</li>
</ul>

</div>

<!-- ARTICLE VI -->
<div class="article" id="article6">

<h3>Article VI</h3>

<h4>Executive Officers</h4>

<p>
    Immediately following election, the Board of Trustees organizes the executive leadership of the corporation:
</p>
<ul>
    <li><strong>Mandated Officers:</strong> The core executive roles comprise a <strong>President</strong> (who must be a Trustee), a <strong>Treasurer</strong> (who must be a resident of the Philippines), and a <strong>Secretary</strong> (who must be a Filipino citizen and resident).</li>
    <li><strong>Term of Office:</strong> Officers are appointed for a term of one (1) year and serve until their qualified successors are chosen.</li>
    <li><strong>Role Separation:</strong> While certain roles may be held concurrently, no individual may serve as President and Secretary, or President and Treasurer at the same time.</li>
</ul>

</div>

<!-- ARTICLE VII -->
<div class="article" id="article7">

<h3>Article VII</h3>

<h4>General & Fiscal Provisions</h4>

<p>
    The organizational parameters, fiscal oversight, and founding members are detailed below:
</p>
<ul>
    <li><strong>Fiscal Year:</strong> Starts on January 1 and concludes on December 31 of each calendar year.</li>
    <li><strong>Amendments:</strong> These bylaws may be modified or amended by a majority vote of both the Board of Trustees and the general membership.</li>
    <li><strong>Unresolved Matters:</strong> Any procedural or legal matters not specifically addressed in these bylaws are governed by the <strong>Revised Corporation Code of the Philippines</strong>.</li>
</ul>

<p style="margin-top: 25px; margin-bottom: 5px; font-weight: 600; color: #111;">Founding Incorporators & Trustees (August 9, 2022):</p>
<div class="founders-grid">
    <div class="founder-card">
        <strong>Rex Esparcia Salico</strong>
        Trustee / Incorporator
    </div>
    <div class="founder-card">
        <strong>Nelton Saligan Pacudan</strong>
        Trustee / Incorporator
    </div>
    <div class="founder-card">
        <strong>Danilo Caballero Raboy</strong>
        Trustee / Incorporator
    </div>
    <div class="founder-card">
        <strong>Marichu Codilla Lucaban</strong>
        Trustee / Incorporator
    </div>
    <div class="founder-card">
        <strong>Jean Licot Oray</strong>
        Trustee / Treasurer
    </div>
    <div class="founder-card">
        <strong>Arnold Ramirez Tobias</strong>
        Trustee / Incorporator
    </div>
    <div class="founder-card">
        <strong>Kirchell Ravidas Pastrano</strong>
        Trustee / Incorporator
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

</body>
</html>