@extends('layouts.app')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@section('content')
<div class="container">
    <div class="profile-container">
        <h1 class="profile-title">Contul Meu</h1>

        <div class="profile-grid">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-card">
                    <div class="profile-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <h3>{{ Auth::user()->name }}</h3>
                    <p>{{ Auth::user()->email }}</p>

                    <div class="profile-menu">
                        <a href="#personal" class="profile-menu-item active">Informații personale</a>
                        <a href="#addresses" class="profile-menu-item">Adrese</a>
                        <a href="#orders" class="profile-menu-item">Comenzile mele</a>
                        <a href="#wishlist" class="profile-menu-item">Favorite</a>
                        <a href="#password" class="profile-menu-item">Schimbă parola</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="profile-content">
                <!-- Personal Information -->
                <div class="profile-section" id="personal">
                    <h2>Informații personale</h2>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nume complet</label>
                            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="tel" name="phone" id="phone" value="{{ Auth::user()->phone ?? '' }}"
                                class="form-control" placeholder="07XX XXX XXX">
                        </div>

                        <button type="submit" class="btn-primary">Salvează modificările</button>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="profile-section" id="password" style="display: none;">
                    <h2>Schimbă parola</h2>

                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="current_password">Parola actuală</label>
                            <input type="password" name="current_password" id="current_password"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password">Parola nouă</label>
                            <input type="password" name="new_password" id="new_password"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Confirmă parola nouă</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="form-control" required>
                        </div>

                        <button type="submit" class="btn-primary">Schimbă parola</button>
                    </form>
                </div>

                <!-- Addresses -->
<div class="profile-section" id="addresses" style="display: none;">
    <h2>Adresele mele</h2>

    <div class="addresses-grid">
        @forelse(Auth::user()->addresses as $address)
            <div class="address-card {{ $address->is_default ? 'default-address' : '' }}">
                @if($address->name)
                    <h4>{{ $address->name }}</h4>
                @endif
                <p><strong>{{ $address->recipient_name }}</strong></p>
                <p>{{ $address->phone }}</p>
                <p>{{ $address->address_line1 }}</p>
                @if($address->address_line2)
                    <p>{{ $address->address_line2 }}</p>
                @endif
                <p>{{ $address->city }}, {{ $address->county }}</p>
                @if($address->postal_code)
                    <p>Cod poștal: {{ $address->postal_code }}</p>
                @endif
                @if($address->is_default)
                    <span class="default-badge">Principală</span>
                @endif
                <div class="address-actions">
                    <a href="{{ route('addresses.edit', $address) }}" class="btn-link">Editează</a>
                    <form method="POST" action="{{ route('addresses.destroy', $address) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-link" onclick="return confirm('Ești sigur?')">Șterge</button>
                    </form>
                    @if(!$address->is_default)
                        <form method="POST" action="{{ route('addresses.default', $address) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-link">Fă principală</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p>Nu ai adăugat încă nicio adresă.</p>
        @endforelse

        <!-- Add new address -->
        <a href="{{ route('addresses.create') }}" class="address-card add-address">
            <span class="add-icon">+</span>
            <p>Adaugă adresă nouă</p>
        </a>
    </div>
</div>
                <!-- Orders -->
                <div class="profile-section" id="orders" style="display: none;">
                    <h2>Comenzile mele</h2>

                    <div class="orders-list">
                        <div class="order-card">
                            <div class="order-header">
                                <span class="order-number">Comandă #12345</span>
                                <span class="order-date">15 Februarie 2026</span>
                                <span class="order-status delivered">Livrată</span>
                            </div>
                            <div class="order-items">
                                <div class="order-item">
                                    <span>Rochie elegantă</span>
                                    <span>1 x 299 RON</span>
                                </div>
                                <div class="order-item">
                                    <span>Colier argint</span>
                                    <span>1 x 159 RON</span>
                                </div>
                            </div>
                            <div class="order-total">
                                <strong>Total: 458 RON</strong>
                            </div>
                            <a href="#" class="btn-link">Vezi detalii</a>
                        </div>

                        <div class="order-card">
                            <div class="order-header">
                                <span class="order-number">Comandă #12344</span>
                                <span class="order-date">10 Februarie 2026</span>
                                <span class="order-status processing">În procesare</span>
                            </div>
                            <div class="order-items">
                                <div class="order-item">
                                    <span>Set îngrijire</span>
                                    <span>1 x 199 RON</span>
                                </div>
                            </div>
                            <div class="order-total">
                                <strong>Total: 199 RON</strong>
                            </div>
                            <a href="#" class="btn-link">Vezi detalii</a>
                        </div>
                    </div>
                </div>

                <!-- Wishlist -->
                <div class="profile-section" id="wishlist" style="display: none;">
                    <h2>Favoritele mele</h2>

                    <div class="wishlist-grid">
                        <div class="wishlist-item">
                            <img src="https://via.placeholder.com/100x100" alt="Produs">
                            <div class="wishlist-info">
                                <h4>Rochie elegantă</h4>
                                <p class="price">299 RON</p>
                                <button class="btn-add-to-cart">Adaugă în coș</button>
                            </div>
                            <button class="wishlist-remove">✕</button>
                        </div>

                        <div class="wishlist-item">
                            <img src="https://via.placeholder.com/100x100" alt="Produs">
                            <div class="wishlist-info">
                                <h4>Colier argint</h4>
                                <p class="price">159 RON</p>
                                <button class="btn-add-to-cart">Adaugă în coș</button>
                            </div>
                            <button class="wishlist-remove">✕</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.profile-menu-item');
        const sections = document.querySelectorAll('.profile-section');

        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all menu items
                menuItems.forEach(i => i.classList.remove('active'));

                // Add active class to clicked item
                this.classList.add('active');

                // Hide all sections
                sections.forEach(s => s.style.display = 'none');

                // Show selected section
                const targetId = this.getAttribute('href');
                document.querySelector(targetId).style.display = 'block';
            });
        });
    });
</script>
@endpush
@endsection
