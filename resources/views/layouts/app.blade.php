<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Miraj') }} - E-commerce for Romanian Women</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/custom.css'])
    
    <!-- Livewire Styles -->
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
                <a href="#contact" class="nav-link">Contact</a>
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
                
                <!-- Cart Icon -->
                <a href="#" class="cart-icon">
                    🛒 <span class="cart-count">0</span>
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