@extends('layouts.app')

@section('content')
<div class="welcome-container">
    <h1 class="welcome-title">✨ Miraj</h1>
    <p class="welcome-subtitle">Eleganță și rafinament pentru femeia modernă</p>
    
    <div class="welcome-buttons">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-white">Contul meu</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-white">Autentificare</a>
            <a href="{{ route('register') }}" class="btn btn-outline-white">Înregistrare</a>
        @endauth
    </div>
</div>
@endsection