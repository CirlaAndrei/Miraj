@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h2>Bine ai revenit!</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Parolă</label>
                <input type="password" name="password" id="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ține-mă minte</label>
            </div>
            
            @if (Route::has('password.request'))
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Ai uitat parola?</a>
                </div>
            @endif
            
            <button type="submit" class="btn-primary">
                Autentifică-te
            </button>
            
            <div class="auth-links">
                Nu ai cont? <a href="{{ route('register') }}">Creează-ți unul</a>
            </div>
        </form>
    </div>
</div>
@endsection