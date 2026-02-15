@extends('layouts.app')

@section('content')
<div class="container">
    <div class="success-container" style="max-width: 600px; margin: 60px auto; text-align: center;">
        <div style="font-size: 80px; color: #28a745; margin-bottom: 20px;">✓</div>
        <h1>Plată reușită!</h1>
        <p style="font-size: 1.2rem; margin: 20px 0; color: #666;">
            Îți mulțumim pentru comandă. Plata a fost procesată cu succes.
        </p>

        <div style="background: #f9f9f9; padding: 25px; border-radius: 10px; margin: 30px 0; text-align: left;">
            <h3>Detalii comandă</h3>
            <p><strong>Număr comandă:</strong> {{ $order->order_number }}</p>
            <p><strong>Total plătit:</strong> {{ number_format($order->total, 0) }} RON</p>
            <p><strong>Status plată:</strong> <span style="color: #28a745;">Confirmată</span></p>
        </div>

        <div style="display: flex; gap: 20px; justify-content: center;">
            <a href="{{ route('orders.show', $order) }}" class="btn-primary">Vezi comanda</a>
            <a href="{{ route('home') }}" class="btn-outline">Continuă cumpărăturile</a>
        </div>
    </div>
</div>
@endsection
