<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barons Society | Member Login</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" href="https://barons-society.onrender.com/images/Barons%20Logo.png" type="image/png">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background: #0a0a0a;
    color: #e5e5e5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
}

/* ================= BACKGROUND HERO OVERLAY ================= */

.hero-bg-overlay {
    position: fixed;
    inset: 0;
    background: 
        url("{{ asset('images/hero background2.jpg') }}") center/cover no-repeat;
    z-index: 0;
    filter: brightness(0.9);
}

/* Fallback background image preview if asset link fails in direct browser view */
.hero-bg-overlay-fallback {
    background-image: 
        linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(10, 10, 10, 0.94) 100%),
        url("https://images.unsplash.com/photo-1541872703-74c5e44368f9?auto=format&fit=crop&w=1920&q=80");
}

/* ================= NAVBAR ================= */

nav{
    position: relative;
    z-index: 10;
    background: rgba(15, 15, 15, 0.75);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    padding: 18px 0;
}

.nav-container{
    width: 90%;
    max-width: 1200px;
    margin: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo{
    display: flex;
    align-items: center;
    gap: 12px;
    color: #fff;
    text-decoration: none;
    font-size: 20px;
    font-weight: 600;
    transition: 0.3s;
}

.logo:hover {
    opacity: 0.9;
}

.logo img{
    width: 42px;
    height: 42px;
    object-fit: cover;
}

.back-home{
    color: #d1d5db;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: 0.3s ease;
}

.back-home:hover{
    color: #111;
    background: #d4af37;
    border-color: #d4af37;
    box-shadow: 0 4px 15px rgba(212,175,55,.3);
    transform: translateX(-3px);
}

/* ================= LOGIN MAIN CARD ================= */

.login-wrapper{
    position: relative;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    flex-grow: 1;
}

.login-card{
    background: rgba(18, 18, 18, 0.85);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    width: 100%;
    max-width: 450px;
    border-radius: 28px;
    padding: 48px 40px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.7), 0 0 40px rgba(212, 175, 55, 0.1);
    position: relative;
    border: 1px solid rgba(212, 175, 55, 0.35);
    overflow: hidden;
}

.login-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #111, #d4af37, #fff, #d4af37, #111);
}

.login-header{
    text-align: center;
    margin-bottom: 32px;
}

.brand-icon{
    width: 86px;
    height: 86px;
    margin: 0 auto 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    transition: transform 0.4s ease;
}


.brand-icon img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.login-header h2{
    font-size: 28px;
    color: #ffffff;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.login-header p{
    font-size: 13.5px;
    color: #a3a3a3;
    margin-top: 6px;
}

/* FORM STYLES */

.form-group{
    margin-bottom: 22px;
}

.form-group label{
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #d4af37;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.input-container{
    position: relative;
    display: flex;
    align-items: center;
}

.input-container svg{
    position: absolute;
    left: 16px;
    color: #888;
    pointer-events: none;
    transition: 0.3s;
}

.form-control{
    width: 100%;
    padding: 14px 16px 14px 48px;
    border: 1.5px solid rgba(255, 255, 255, 0.12);
    border-radius: 14px;
    font-size: 14px;
    color: #ffffff;
    background: rgba(255, 255, 255, 0.04);
    transition: 0.3s ease;
    outline: none;
}

.form-control::placeholder {
    color: #666;
}

.form-control:focus{
    border-color: #d4af37;
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
}

.form-control:focus + svg,
.input-container:focus-within svg {
    color: #d4af37;
}

.login-btn{
    width: 100%;
    padding: 15px;
    background: #d4af37;
    color: #111;
    border: none;
    border-radius: 14px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.3s ease;
    margin-top: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 6px 20px rgba(212, 175, 55, 0.25);
}

.login-btn:hover{
    background: #ffffff;
    color: #111;
    box-shadow: 0 10px 25px rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.login-btn:active {
    transform: translateY(0);
}

/* ALERT ERROR BOX */

.alert-error{
    background: rgba(153, 27, 27, 0.2);
    border: 1px solid rgba(248, 113, 113, 0.4);
    color: #fca5a5;
    padding: 12px 16px;
    border-radius: 12px;
    font-size: 13px;
    margin-bottom: 22px;
    display: none;
    line-height: 1.5;
}

/* SECURITY BADGE */

.security-notice{
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    text-align: center;
    font-size: 12px;
    color: #888;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

/* FOOTER */

footer{
    position: relative;
    z-index: 10;
    background: rgba(10, 10, 10, 0.85);
    backdrop-filter: blur(10px);
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding: 22px 0;
    text-align: center;
    color: #777;
    font-size: 13px;
}

@media(max-width: 500px){
    .login-card{
        padding: 38px 24px;
    }
    
    .login-header h2 {
        font-size: 24px;
    }
}
</style>
</head>

<body>

<div class="hero-bg-overlay" onerror="this.classList.add('hero-bg-overlay-fallback')"></div>

<nav>
    <div class="nav-container">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/Barons Logo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
            <span>Barons Society Inc.</span>
        </a>

        <!-- Redirect back to Home (url /) -->
        <a href="{{ url('/') }}" class="back-home">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            <span>Back to Home</span>
        </a>
    </div>
</nav>

<main class="login-wrapper">
    <div class="login-card">
        
        <div class="login-header">
            <div class="brand-icon">
                <img src="{{ asset('images/Barons Logo.png') }}" onerror="this.src='https://placehold.co/100x100/111/d4af37?text=BS'" alt="Barons Logo">
            </div>
            <h2>Member Portal</h2>
            <p>Access your Barons Society alumni account</p>
        </div>

        <!-- Laravel Session Error Notice / Dynamic JS Alert -->
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

    <div class="form-group">
        <label>Email Address</label>

        <div class="input-container">
            <input
                id="email"
                type="email"
                name="email"
                class="form-control"
                placeholder="Enter your email"
                value="{{ old('email') }}"
                required>
        </div>
    </div>

    <div class="form-group">
        <label>Password</label>

        <div class="input-container">
            <input
                id="password"
                type="password"
                name="password"
                class="form-control"
                placeholder="Enter your password"
                required>
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

    if(!email || !password) {
        e.preventDefault();
        errorAlert.style.display = 'block';
        errorAlert.textContent = 'Please fill in both email and password fields.';
    }
});
</script>

</body>
</html>