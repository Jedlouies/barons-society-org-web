<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barons Society | Bylaws</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/BaronsLogo.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

<nav>

<div class="container nav-container">

<div class="logo">
<img src="{{ asset('images/BaronsLogo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
<span>Barons Society Incorporated</span>
</div>

<div class="nav-links">
<a href="{{ url('/dashboard') }}">Dashboard</a>
<a href="{{ url('/blogs') }}" >News and Updates</a>
<a href="{{ url('/member-classes') }}">Classes</a>
<a href="{{ url('/bylaws') }}" class="active">Bylaws</a>
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
                    <img src="{{ asset('images/BaronsLogo.png') }}" alt="" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'">
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
             © {{ date('Y') }} Barons Society ROTC Alumni Incorporated.
            All Rights Reserved.
        </div>

    </div>

</footer>

</body>
</html>