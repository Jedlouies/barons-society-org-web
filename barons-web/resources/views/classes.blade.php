<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Barons Society | Classes</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/BaronsLogo.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

<nav>

<div class="container nav-container">

<div class="logo">
<img src="{{ asset('images/BaronsLogo.png') }}">
Barons Society Incorporated
</div>

<div class="nav-links">
<a href="{{ url('/') }}">Home</a>
<a href="{{ url('/classes') }}" class="active">Classes</a>
 <a href="{{ url('/login') }}" class="nav-login-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Member Login
    </a>
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