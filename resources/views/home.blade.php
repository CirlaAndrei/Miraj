@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">✨ Miraj</h1>
            <p class="hero-subtitle">Eleganță și rafinament pentru femeia modernă</p>
            <p class="hero-description">Descoperă colecția noastră exclusivă de produse premium</p>
            <div class="hero-buttons">
                <a href="#produse" class="btn btn-primary">Descoperă Colecția</a>
                <a href="#noutati" class="btn btn-outline">Noutăți</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">De ce să alegi Miraj?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">✨</div>
                    <h3>Produse Premium</h3>
                    <p>Selecționăm cu grijă cele mai fine produse pentru tine</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🚚</div>
                    <h3>Livrare Rapidă</h3>
                    <p>În toată România în maxim 48 de ore</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💝</div>
                    <h3>Ambalațaj Cadou</h3>
                    <p>Pentru momentele speciale din viața ta</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3>Suport Clienți</h3>
                    <p>Echipa noastră te ajută cu drag</p>
                </div>
            </div>
        </div>
    </section>

   <!-- Categories Section -->
<!-- Categories Section -->
<section class="categories-section" id="categorii">
    <div class="container">
        <h2 class="section-title">Categorii Populare</h2>
        <p class="section-subtitle">Descoperă produsele noastre pe categorii</p>

        <div class="categories-grid">
            <!-- Moda Category -->
            <a href="#" class="category-card">
                <div class="category-image" style="background-image: url('https://images.unsplash.com/photo-1539008835657-9e8e9680c956?w=600&auto=format');">
                    <div class="category-overlay"></div>
                </div>
                <div class="category-content">
                    <h3>Modă</h3>
                    <p>Rochie, fuste, bluze și accesorii</p>
                    <span class="category-link">Explorează →</span>
                </div>
            </a>

            <!-- Accesorii Category -->
            <a href="#" class="category-card">
                <div class="category-image" style="background-image: url('https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=600&auto=format');">
                    <div class="category-overlay"></div>
                </div>
                <div class="category-content">
                    <h3>Accesorii</h3>
                    <p>Bijuterii, genți, curele și eșarfe</p>
                    <span class="category-link">Explorează →</span>
                </div>
            </a>

            <!-- Ingrijire Category -->
            <a href="#" class="category-card">
                <div class="category-image" style="background-image: url('https://images.unsplash.com/photo-1556229010-6c3f2c9ca5f8?w=600&auto=format');">
                    <div class="category-overlay"></div>
                </div>
                <div class="category-content">
                    <h3>Îngrijire</h3>
                    <p>Produse cosmetice și parfumuri</p>
                    <span class="category-link">Explorează →</span>
                </div>
            </a>

            <!-- Cadouri Category -->
            <a href="#" class="category-card">
                <div class="category-image" style="background-image: url('https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=600&auto=format');">
                    <div class="category-overlay"></div>
                </div>
                <div class="category-content">
                    <h3>Cadouri</h3>
                    <p>Seturi cadou pentru orice ocazie</p>
                    <span class="category-link">Explorează →</span>
                </div>
            </a>
        </div>
    </div>
</section>

        <!-- Featured Products Section -->
    <section class="products-section" id="produse">
        <div class="container">
            <h2 class="section-title">Produse Recomandate</h2>
            <p class="section-subtitle">Cele mai populare produse ale lunii</p>

            <div class="products-grid">
                @forelse($featuredProducts as $product)
                    <div class="product-card">
                        @if($product->sale_price)
                            <div class="product-badge product-badge-sale">
                                -{{ $product->discount_percentage }}%
                            </div>
                        @elseif($product->is_featured)
                            <div class="product-badge">Recomandat</div>
                        @endif

                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">

                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-category">{{ $product->category }}</p>

                            <div class="product-price">
                                @if($product->sale_price)
                                    <span class="current-price">{{ number_format($product->sale_price, 0) }} RON</span>
                                    <span class="old-price">{{ number_format($product->price, 0) }} RON</span>
                                @else
                                    <span class="current-price">{{ number_format($product->price, 0) }} RON</span>
                                @endif
                            </div>

                            <div class="product-actions">
                                <a href="{{ route('product.show', $product->slug) }}" class="btn-add-to-cart">Vezi detalii</a>
                                <button class="btn-wishlist">❤️</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Nu există produse momentan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="products-section" style="background: #f9f9f9;">
        <div class="container">
            <h2 class="section-title">Noutăți</h2>
            <p class="section-subtitle">Cele mai noi produse adăugate în colecție</p>

            <div class="products-grid">
                @forelse($newProducts as $product)
                    <div class="product-card">
                        <div class="product-badge">Nou</div>

                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">

                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-category">{{ $product->category }}</p>

                            <div class="product-price">
                                <span class="current-price">{{ number_format($product->price, 0) }} RON</span>
                            </div>

                            <div class="product-actions">
                                <a href="{{ route('product.show', $product->slug) }}" class="btn-add-to-cart">Vezi detalii</a>
                                <button class="btn-wishlist">❤️</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Nu există produse noi momentan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Primește oferte exclusive</h2>
                <p>Abonează-te la newsletter și beneficiezi de 10% reducere la prima comandă</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Adresa ta de email" required>
                    <button type="submit" class="btn btn-primary">Abonează-te</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Instagram Feed Section -->
    <section class="instagram-section">
        <div class="container">
            <h2 class="section-title">Urmărește-ne pe Instagram</h2>
            <p class="section-subtitle">@miraj_romania</p>
            <div class="instagram-grid">
                <div class="instagram-item" style="background-image: url('https://via.placeholder.com/300x300');"></div>
                <div class="instagram-item" style="background-image: url('https://via.placeholder.com/300x300');"></div>
                <div class="instagram-item" style="background-image: url('https://via.placeholder.com/300x300');"></div>
                <div class="instagram-item" style="background-image: url('https://via.placeholder.com/300x300');"></div>
                <div class="instagram-item" style="background-image: url('https://via.placeholder.com/300x300');"></div>
                <div class="instagram-item" style="background-image: url('https://via.placeholder.com/300x300');"></div>
            </div>
        </div>
    </section>
@endsection
