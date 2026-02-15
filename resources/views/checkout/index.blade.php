@extends('layouts.app')

@section('content')
<div class="container">
    <div class="checkout-container">
        <h1 class="checkout-title">Finalizează comanda</h1>

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="checkout-grid">
            <!-- Checkout Form -->
            <div class="checkout-form">
                <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form">
                    @csrf

                    <!-- Shipping Address -->
                    <div class="checkout-section">
                        <h2>1. Adresa de livrare</h2>

                        @if($addresses->isEmpty())
                            <div class="no-address">
                                <p>Nu ai adăugat nicio adresă.</p>
                                <a href="{{ route('addresses.create') }}" class="btn-primary" style="display: inline-block; width: auto;">Adaugă adresă</a>
                            </div>
                        @else
                            <div class="address-selector">
                                @foreach($addresses as $address)
                                    <label class="address-option">
                                        <input type="radio" name="shipping_address_id" value="{{ $address->id }}"
                                            {{ $loop->first ? 'checked' : '' }} required>
                                        <div class="address-details">
                                            <strong>{{ $address->name ?: 'Adresă' }}</strong>
                                            <p>{{ $address->recipient_name }}</p>
                                            <p>{{ $address->phone }}</p>
                                            <p>{{ $address->address_line1 }}</p>
                                            @if($address->address_line2)
                                                <p>{{ $address->address_line2 }}</p>
                                            @endif
                                            <p>{{ $address->city }}, {{ $address->county }}</p>
                                            @if($address->postal_code)
                                                <p>Cod poștal: {{ $address->postal_code }}</p>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <div class="add-address-link">
                                <a href="{{ route('addresses.create') }}">+ Adaugă o adresă nouă</a>
                            </div>
                        @endif
                    </div>

                    <!-- Billing Address -->
                    <div class="checkout-section">
                        <h2>2. Adresa de facturare</h2>

                        <label class="same-as-shipping">
                            <input type="checkbox" name="same_as_shipping" value="1" checked id="same-as-shipping">
                            <span>Same as shipping address</span>
                        </label>

                        <div id="billing-address-section" style="display: none; margin-top: 20px;">
                            <div class="address-selector">
                                @foreach($addresses as $address)
                                    <label class="address-option">
                                        <input type="radio" name="billing_address_id" value="{{ $address->id }}">
                                        <div class="address-details">
                                            <strong>{{ $address->name ?: 'Adresă' }}</strong>
                                            <p>{{ $address->recipient_name }}</p>
                                            <p>{{ $address->phone }}</p>
                                            <p>{{ $address->address_line1 }}</p>
                                            @if($address->address_line2)
                                                <p>{{ $address->address_line2 }}</p>
                                            @endif
                                            <p>{{ $address->city }}, {{ $address->county }}</p>
                                            @if($address->postal_code)
                                                <p>Cod poștal: {{ $address->postal_code }}</p>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                   <!-- Payment Method -->
            <div class="checkout-section">
                <h2>3. Metoda de plată</h2>

                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="card" checked>
                        <span>💳 Card bancar (plăți sigure cu Stripe)</span>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="ramburs">
                        <span>💵 Ramburs la livrare</span>
                    </label>
                </div>
            </div>

                    <!-- Order Notes -->
                    <div class="checkout-section">
                        <h2>4. Observații (opțional)</h2>

                        <textarea name="notes" rows="4" class="form-control" placeholder="Lasă un mesaj pentru curier sau observații despre comandă..."></textarea>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="checkout-summary">
                <h2>Sumar comandă</h2>

                <div class="summary-items">
                    @foreach($cartItems as $item)
                        <div class="summary-item">
                            <span class="item-name">{{ $item->product->name }} x{{ $item->quantity }}</span>
                            <span class="item-price">{{ number_format($item->subtotal, 0) }} RON</span>
                        </div>
                    @endforeach
                </div>

                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>{{ number_format($subtotal, 0) }} RON</span>
                </div>

                <div class="summary-row">
                    <span>Transport:</span>
                    <span>{{ number_format($shipping, 0) }} RON</span>
                </div>

                <div class="summary-row total">
                    <span>Total:</span>
                    <span>{{ number_format($total, 0) }} RON</span>
                </div>

                <button type="submit" form="checkout-form" class="btn-primary btn-place-order">
                    Plasează comanda
                </button>

                <p class="checkout-terms">
                    Prin plasarea comenzii, ești de acord cu <a href="#">termenii și condițiile</a> noastre.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('same-as-shipping').addEventListener('change', function() {
    document.getElementById('billing-address-section').style.display = this.checked ? 'none' : 'block';

    // Toggle required attribute for billing address
    const billingRadios = document.querySelectorAll('input[name="billing_address_id"]');
    billingRadios.forEach(radio => {
        radio.required = !this.checked;
    });
});
</script>
@endsection
