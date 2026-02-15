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
    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">Categorii Populare</h2>
            <div class="categories-grid">
                <a href="#" class="category-card">
                    <div class="category-image" style="background-image: url('https://via.placeholder.com/400x300');">
                        <div class="category-overlay">
                            <h3>Modă</h3>
                            <span>Explorează →</span>
                        </div>
                    </div>
                </a>
                <a href="#" class="category-card">
                    <div class="category-image" style="background-image: url('https://via.placeholder.com/400x300');">
                        <div class="category-overlay">
                            <h3>Accesorii</h3>
                            <span>Explorează →</span>
                        </div>
                    </div>
                </a>
                <a href="#" class="category-card">
                    <div class="category-image" style="background-image: url('https://via.placeholder.com/400x300');">
                        <div class="category-overlay">
                            <h3>Îngrijire</h3>
                            <span>Explorează →</span>
                        </div>
                    </div>
                </a>
                <a href="#" class="category-card">
                    <div class="category-image" style="background-image: url('https://via.placeholder.com/400x300');">
                        <div class="category-overlay">
                            <h3>Cadouri</h3>
                            <span>Explorează →</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="products-section" id="produse">
        <div class="container">
            <h2 class="section-title">Produse Recomandate</h2>
            <div class="products-grid">
                <!-- Product Card 1 -->
                <div class="product-card">
                    <div class="product-badge">Nou</div>
                    <img src="https://via.placeholder.com/300x300" alt="Produs" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">Rochie Elegantă</h3>
                        <p class="product-category">Modă</p>
                        <div class="product-price">
                            <span class="current-price">299 RON</span>
                            <span class="old-price">399 RON</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn-add-to-cart">Adaugă în coș</button>
                            <button class="btn-wishlist">❤️</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-card">
                    <img src="https://via.placeholder.com/300x300" alt="Produs" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">Colier Argint</h3>
                        <p class="product-category">Accesorii</p>
                        <div class="product-price">
                            <span class="current-price">159 RON</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn-add-to-cart">Adaugă în coș</button>
                            <button class="btn-wishlist">❤️</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="product-card">
                    <div class="product-badge product-badge-sale">-20%</div>
                    <img src="https://via.placeholder.com/300x300" alt="Produs" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">Set Îngrijire</h3>
                        <p class="product-category">Îngrijire</p>
                        <div class="product-price">
                            <span class="current-price">199 RON</span>
                            <span class="old-price">249 RON</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn-add-to-cart">Adaugă în coș</button>
                            <button class="btn-wishlist">❤️</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="product-card">
                    <img src="https://via.placeholder.com/300x300" alt="Produs" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">Geantă Piele</h3>
                        <p class="product-category">Accesorii</p>
                        <div class="product-price">
                            <span class="current-price">459 RON</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn-add-to-cart">Adaugă în coș</button>
                            <button class="btn-wishlist">❤️</button>
                        </div>
                    </div>
                </div>
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