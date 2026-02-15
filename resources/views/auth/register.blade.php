@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h2>Crează-ți cont Miraj</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Nume complet</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="form-control @error('name') is-invalid @enderror" 
                    required autofocus>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    required>
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
            
            <div class="form-group">
                <label for="password_confirmation">Confirmă parola</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="form-control" required>
            </div>
            
            <button type="submit" class="btn-primary">
                Înregistrează-te
            </button>
            
            <div class="auth-links">
                Ai deja cont? <a href="{{ route('login') }}">Autentifică-te aici</a>
            </div>
        </form>
    </div>
</div>
@endsection