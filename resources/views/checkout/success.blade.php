@extends('layouts.app')

@section('content')
<div class="container">
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">✓</div>

            <h1>Comandă plasată cu succes!</h1>

            <p class="success-message">
                Îți mulțumim pentru comandă! Vei primi un email de confirmare în curând.
            </p>

            <div class="order-info">
                <h2>Detalii comandă</h2>

                <div class="info-row">
                    <span>Număr comandă:</span>
                    <strong>{{ $order->order_number }}</strong>
                </div>

                <div class="info-row">
                    <span>Data:</span>
                    <strong>{{ $order->created_at->format('d M Y, H:i') }}</strong>
                </div>

                <div class="info-row">
                    <span>Total plată:</span>
                    <strong>{{ number_format($order->total, 0) }} RON</strong>
                </div>

                <div class="info-row">
                    <span>Status plată:</span>
                    <strong class="status-{{ $order->payment_status }}">
                        {{ $order->payment_status === 'pending' ? 'În așteptare' : 'Achitat' }}
                    </strong>
                </div>
            </div>

            <div class="success-actions">
                <a href="{{ route('profile') }}#orders" class="btn-primary">Vezi comenzile mele</a>
                <a href="{{ route('home') }}" class="btn-outline">Continuă cumpărăturile</a>
            </div>
        </div>
    </div>
</div>

<style>
.success-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 60vh;
    padding: 40px 20px;
}

.success-card {
    background: white;
    border-radius: 10px;
    padding: 50px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    max-width: 600px;
    width: 100%;
    text-align: center;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-size: 3rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
}

.success-card h1 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 15px;
}

.success-message {
    color: #666;
    margin-bottom: 30px;
    font-size: 1.1rem;
}

.order-info {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 30px;
    margin: 30px 0;
    text-align: left;
}

.order-info h2 {
    font-size: 1.3rem;
    margin-bottom: 20px;
    color: #333;
}

.info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e0e0e0;
}

.info-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.status-pending {
    color: #856404;
}

.success-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
}

@media (max-width: 768px) {
    .success-card {
        padding: 30px 20px;
    }

    .success-actions {
        flex-direction: column;
    }
}
</style>
@endsection
