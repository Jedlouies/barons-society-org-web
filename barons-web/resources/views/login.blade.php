<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barons Society | Member Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/BaronsLogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<div class="hero-bg-overlay" onerror="this.classList.add('hero-bg-overlay-fallback')"></div>

<nav>
    <div class="nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/BaronsLogo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
            <span>Barons Society Incorporated</span>
        </a>

        <!-- Redirect back to Home -->
        <a href="{{ url('/') }}" class="back-home">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>
            <span>Back to Home</span>
        </a>
    </div>
</nav>

<main class="login-wrapper">
    <div class="login-card">
        
        <div class="login-header">
            <div class="brand-icon">
                <img src="{{ asset('images/BaronsLogo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
            </div>
            <h2>Member Portal</h2>
            <p>Access your Barons Society alumni account</p>
        </div>

        <!-- Session Error Notice / Dynamic JS Alert -->
        @if ($errors->any())
            <div class="alert-error" style="display: block;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @else
            <div id="errorAlert" class="alert-error">
                Invalid credentials. Please verify your email and password.
            </div>
        @endif

        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-container">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                        autofocus>

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-container">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required>

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
            </div>

            <button type="submit" class="login-btn">
                Login
            </button>
        </form>

    </div>
</main>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorAlert = document.getElementById('errorAlert');

    if (!email || !password) {
        e.preventDefault();
        if (errorAlert) {
            errorAlert.style.display = 'block';
            errorAlert.textContent = 'Please fill in both email and password fields.';
        }
    }
});
</script>

</body>
</html>