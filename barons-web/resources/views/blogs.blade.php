<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barons Society | Updates</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="https://barons-society.onrender.com/images/Barons%20Logo.png" type="image/png">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

<nav>

<div class="container nav-container">

<div class="logo">
<img src="{{ asset('images/Barons Logo.png') }}">
<span>Barons Society Incorporated</span>
</div>

<div class="nav-links">
<a href="{{ url('/dashboard') }}">Dashboard</a>
<a href="{{ url('/blogs') }}" class="active">News and Updates</a>
<a href="{{ url('/member-classes') }}">Classes</a>
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

<div class="container" id="latest-updates-section">

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