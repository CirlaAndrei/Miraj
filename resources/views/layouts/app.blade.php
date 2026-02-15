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
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body>
    <!-- Navigation -->
   <!-- In the navbar-links div, replace with: -->
<div class="navbar-links">
    <a href="{{ route('home') }}">Acasă</a>
    <a href="#produse">Produse</a>
    <a href="#categorii">Categorii</a>
    <a href="#oferte">Oferte</a>
    <a href="#contact">Contact</a>
    
    @auth
        <span>Bună, {{ Auth::user()->name }}!</span>
        <a href="{{ route('dashboard') }}">Contul meu</a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
    
    <!-- Cart Icon -->
    <a href="#" class="cart-icon">
        🛒 <span class="cart-count">0</span>
    </a>
</div>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>