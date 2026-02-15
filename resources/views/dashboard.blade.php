@extends('layouts.app')

@section('content')
<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <h2>Bună, {{ Auth::user()->name }}!</h2>
            <p>Bine ai venit în contul tău Miraj.</p>
            <p>Email: {{ Auth::user()->email }}</p>
            <div style="margin-top: 20px;">
                <a href="/" class="btn-primary" style="text-decoration: none; display: inline-block; width: auto; padding: 10px 20px;">Înapoi la magazin</a>
            </div>
        </div>
    </div>
</div>
@endsection