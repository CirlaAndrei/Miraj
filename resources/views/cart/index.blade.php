@extends('layouts.app')

@section('content')
<div class="container">
    <div class="cart-container">
        <h1 class="cart-title">Coșul tău de cumpărături</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($cartItems->isEmpty())
            <div class="empty-cart">
                <p>Coșul tău este gol.</p>
                <a href="{{ route('home') }}" class="btn-primary" style="display: inline-block; width: auto; margin-top: 20px;">Continuă cumpărăturile</a>
            </div>
        @else
            <div class="cart-grid">
                <!-- Cart Items -->
                <div class="cart-items">
                    @foreach($cartItems as $item)
                        <div class="cart-item">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="cart-item-image">

                            <div class="cart-item-info">
                                <h3>{{ $item->product->name }}</h3>
                                <p class="cart-item-category">{{ $item->product->category }}</p>
                                <p class="cart-item-price">{{ number_format($item->product->display_price, 0) }} RON</p>
                            </div>

                            <div class="cart-item-quantity">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="quantity-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="quantity-selector">
                                        <button type="button" class="quantity-btn" onclick="decrement(this)">-</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}" class="quantity-input" readonly>
                                        <button type="button" class="quantity-btn" onclick="increment(this)">+</button>
                                    </div>
                                    <button type="submit" class="btn-update">Actualizează</button>
                                </form>
                            </div>

                            <div class="cart-item-subtotal">
                                <span class="subtotal-label">Subtotal:</span>
                                <span class="subtotal-value">{{ number_format($item->subtotal, 0) }} RON</span>
                            </div>

                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="cart-item-remove">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove" onclick="return confirm('Ești sigur că vrei să elimini acest produs?')">✕</button>
                            </form>
                        </div>
                    @endforeach

                    <form action="{{ route('cart.clear') }}" method="POST" class="cart-clear">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-clear" onclick="return confirm('Ești sigur că vrei să golești coșul?')">Golește coșul</button>
                    </form>
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h2>Sumar comandă</h2>

                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>{{ number_format($subtotal, 0) }} RON</span>
                    </div>

                    <div class="summary-row">
                        <span>Transport:</span>
                        <span>Va fi calculat la final</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>{{ number_format($subtotal, 0) }} RON</span>
                    </div>

                    <a href="#" class="btn-primary btn-checkout">Finalizează comanda</a>

                    <a href="{{ route('home') }}" class="btn-continue">Continuă cumpărăturile</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function increment(btn) {
    let input = btn.parentNode.querySelector('.quantity-input');
    input.value = parseInt(input.value) + 1;
}

function decrement(btn) {
    let input = btn.parentNode.querySelector('.quantity-input');
    let newValue = parseInt(input.value) - 1;
    if (newValue >= 1) {
        input.value = newValue;
    }
}
</script>
@endpush
