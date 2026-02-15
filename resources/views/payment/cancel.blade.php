@extends('layouts.app')

@section('content')
<div class="container">
    <div style="max-width: 500px; margin: 60px auto; text-align: center;">
        <div style="font-size: 80px; color: #dc3545; margin-bottom: 20px;">✗</div>
        <h1>Plată anulată</h1>
        <p style="font-size: 1.2rem; margin: 20px 0; color: #666;">
            Ai anulat procesul de plată. Comanda ta nu a fost procesată.
        </p>

        <div style="display: flex; gap: 20px; justify-content: center; margin-top: 30px;">
            <a href="{{ route('cart.index') }}" class="btn-primary">Înapoi la coș</a>
            <a href="{{ route('home') }}" class="btn-outline">Continuă cumpărăturile</a>
        </div>
    </div>
</div>
@endsection
