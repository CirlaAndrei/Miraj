<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>Miraj - Modă și Accesorii pentru Femei | E-commerce România</title>
    <meta name="title" content="Miraj - Modă și Accesorii pentru Femei | E-commerce România">
    <meta name="description" content="Miraj - Descoperă colecția noastră exclusivă de modă, accesorii și produse de îngrijire pentru femei. Cumpărături sigure și livrare rapidă în toată România.">
    <meta name="keywords" content="modă feminină, accesorii, îngrijire personală, parfumuri, cadouri, e-commerce românia, cumpărături online, haine, bijuterii, cosmetice">

    <!-- Author & Ownership -->
    <meta name="author" content="Miraj">
    <meta name="designer" content="Miraj Team">
    <meta name="publisher" content="Miraj">
    <meta name="copyright" content="https://miraj.ro">
    <meta name="owner" content="Miraj">

    <!-- Robots & Indexing -->
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

    <!-- Verification (Replace with your actual verification codes) -->
    <meta name="google-site-verification" content="YOUR_GOOGLE_VERIFICATION_CODE">
    <meta name="msvalidate.01" content="YOUR_BING_VERIFICATION_CODE">
    <meta name="ahrefs-site-verification" content="YOUR_AHREFS_VERIFICATION_CODE">

    <!-- Canonical & Language -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="language" content="RO">
    <meta name="geo.region" content="RO">
    <meta name="geo.placename" content="Romania">

    <!-- Mobile & Browser -->
    <meta name="theme-color" content="#764ba2">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Miraj - Modă și Accesorii pentru Femei">
    <meta property="og:description" content="Descoperă colecția noastră exclusivă de modă, accesorii și produse de îngrijire pentru femei. Cumpărături sigure și livrare rapidă.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Miraj">
    <meta property="og:locale" content="ro_RO">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Miraj - Modă și Accesorii pentru Femei">
    <meta name="twitter:description" content="Descoperă colecția noastră exclusivă de modă, accesorii și produse de îngrijire pentru femei.">
    <meta name="twitter:image" content="{{ asset('images/twitter-image.jpg') }}">
    <meta name="twitter:site" content="@miraj_romania">
    <meta name="twitter:creator" content="@miraj_romania">

    <!-- Business & Contact Info -->
    <meta property="business:contact_data:country_name" content="România">
    <meta property="business:contact_data:locality" content="București">
    <meta property="business:contact_data:email" content="contact@miraj.ro">
    <meta property="business:contact_data:phone_number" content="+40 123 456 789">

    <!-- Article Meta (for blog posts) -->
    <meta property="article:author" content="Miraj">
    <meta property="article:publisher" content="https://facebook.com/miraj">

    <!-- Sitemap & RSS -->
    <link rel="sitemap" type="application/xml" href="{{ url('/sitemap.xml') }}">
    <link rel="alternate" type="application/rss+xml" title="Miraj - Produse Noi" href="{{ url('/feed') }}">

    <!-- Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Preconnect & Preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preload" as="image" href="{{ asset('images/hero-bg.jpg') }}">
    <link rel="preload" as="font" href="{{ asset('fonts/poppins.woff2') }}" type="font/woff2" crossorigin>

    <!-- Your existing Vite and Livewire directives -->
    @vite(['resources/css/custom.css'])
    @livewireStyles
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-logo">✨ Miraj</a>

            <!-- Main Navigation Links -->
            <div class="navbar-menu">
                <a href="{{ route('home') }}" class="nav-link">Acasă</a>
                <a href="#produse" class="nav-link">Produse</a>
                <a href="#categorii" class="nav-link">Categorii</a>
                <a href="#oferte" class="nav-link">Oferte</a>
                <a href="{{ route('contact') }}" class="nav-link">Contact</a>

    <!-- Admin Link - Only visible to admins -->
    @auth
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="nav-link" style="color: #764ba2; font-weight: bold;">
                👑 Admin
            </a>
        @endif
    @endauth
            </div>

            <!-- Right Side Links (Auth + Cart) -->
            <div class="navbar-actions">
                @auth
                    <span class="user-greeting">Bună, {{ Auth::user()->name }}!</span>
                    <a href="{{ route('profile') }}" class="nav-link">Contul meu</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endauth

                <<!-- Cart Icon -->
        <a href="{{ route('cart.index') }}" class="cart-icon">
            🛒
            @php
                use App\Models\Cart;
                $cartCount = 0;
                if(Auth::check()) {
                    $cartCount = Cart::where('user_id', Auth::id())->count();
                } else {
                    $cartCount = Cart::where('session_id', session('cart_session_id'))->count();
                }
            @endphp
            @if($cartCount > 0)
                <span class="cart-count">{{ $cartCount }}</span>
            @endif
        </a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Livewire Scripts -->
    @livewireScripts
        @stack('scripts')

</body>
</html>
