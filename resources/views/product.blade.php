@extends('layouts.app')

@section('content')
<div class="container">
    <div class="product-detail-container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <a href="/">Acasă</a> /
            <a href="#">{{ $product->category }}</a> /
            <span>{{ $product->name }}</span>
        </div>

        <div class="product-detail-grid">
            <!-- Product Image -->
            <div class="product-image-section">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-main-image">
            </div>

            <!-- Product Info -->
            <div class="product-info-section">
                <h1 class="product-detail-title">{{ $product->name }}</h1>

                <div class="product-detail-price">
                    @if($product->sale_price)
                        <span class="current-price">{{ number_format($product->sale_price, 0) }} RON</span>
                        <span class="old-price">{{ number_format($product->price, 0) }} RON</span>
                        <span class="sale-badge">-{{ $product->discount_percentage }}%</span>
                    @else
                        <span class="current-price">{{ number_format($product->price, 0) }} RON</span>
                    @endif
                </div>

                <div class="product-availability">
                    @if($product->isInStock())
                        <span class="in-stock">✓ În stoc ({{ $product->stock_quantity }} buc.)</span>
                    @else
                        <span class="out-of-stock">✗ Stoc epuizat</span>
                    @endif
                </div>

                <div class="product-description">
                    <h3>Descriere</h3>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="product-meta">
                    <p><strong>SKU:</strong> {{ $product->sku }}</p>
                    <p><strong>Categorie:</strong> {{ $product->category }}</p>
                    @if($product->tags)
                        <p><strong>Tag-uri:</strong>
                            @foreach($product->tags as $tag)
                                <span class="product-tag">{{ $tag }}</span>
                            @endforeach
                        </p>
                    @endif
                </div>

                <div class="product-cart-actions">
    <form action="{{ route('cart.add', $product) }}" method="POST">
        @csrf
        <input type="hidden" name="quantity" value="1" id="cart-quantity">
        <div class="quantity-selector">
            <button type="button" class="quantity-btn" onclick="decrementCart()">-</button>
            <input type="number" value="1" min="1" max="{{ $product->stock_quantity }}" class="quantity-input" id="display-quantity" readonly>
            <button type="button" class="quantity-btn" onclick="incrementCart()">+</button>
        </div>
        <button type="submit" class="btn-add-to-cart-large" {{ !$product->isInStock() ? 'disabled' : '' }}>
            Adaugă în coș
        </button>
    </form>

    <button class="btn-wishlist-large">❤️ Adaugă la favorite</button>
</div>

@push('scripts')
<script>
function incrementCart() {
    let input = document.getElementById('display-quantity');
    let hiddenInput = document.getElementById('cart-quantity');
    let newValue = parseInt(input.value) + 1;
    if (newValue <= {{ $product->stock_quantity }}) {
        input.value = newValue;
        hiddenInput.value = newValue;
    }
}

function decrementCart() {
    let input = document.getElementById('display-quantity');
    let hiddenInput = document.getElementById('cart-quantity');
    let newValue = parseInt(input.value) - 1;
    if (newValue >= 1) {
        input.value = newValue;
        hiddenInput.value = newValue;
    }
}
</script>
@endpush
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <section class="related-products">
                <h2 class="section-title">Produse similare</h2>

                <div class="products-grid">
                    @foreach($relatedProducts as $related)
                        <div class="product-card">
                            <img src="{{ $related->image }}" alt="{{ $related->name }}" class="product-image">
                            <div class="product-info">
                                <h3 class="product-title">{{ $related->name }}</h3>
                                <div class="product-price">
                                    <span class="current-price">{{ number_format($related->price, 0) }} RON</span>
                                </div>
                                <a href="{{ route('product.show', $related->slug) }}" class="btn-add-to-cart">Vezi detalii</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
@endsection
