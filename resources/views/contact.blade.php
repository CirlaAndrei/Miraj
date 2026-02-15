@extends('layouts.app')

@section('content')
<div class="container">
    <div class="contact-container">
        <h1 class="contact-title">Contactează-ne</h1>

        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info">
                <div class="info-card">
                    <h2>Informații de contact</h2>

                    <div class="info-item">
                        <span class="info-icon">📍</span>
                        <div>
                            <h3>Adresă</h3>
                            <p>Strada Exemplu, Nr. 123</p>
                            <p>București, Sector 1</p>
                            <p>Cod poștal: 012345</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon">📞</span>
                        <div>
                            <h3>Telefon</h3>
                            <p>+40 123 456 789</p>
                            <p>Luni - Vineri: 9:00 - 18:00</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon">✉️</span>
                        <div>
                            <h3>Email</h3>
                            <p>contact@miraj.ro</p>
                            <p>suport@miraj.ro</p>
                        </div>
                    </div>

                    <div class="social-links">
                        <h3>Urmărește-ne</h3>
                        <div class="social-icons">
                            <a href="#" class="social-icon">📘</a>
                            <a href="#" class="social-icon">📷</a>
                            <a href="#" class="social-icon">🐦</a>
                            <a href="#" class="social-icon">📌</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <div class="form-card">
                    <h2>Trimite-ne un mesaj</h2>

                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nume complet *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subject">Subiect *</label>
                            <select name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
                                <option value="">Selectează un subiect</option>
                                <option value="info" {{ old('subject') == 'info' ? 'selected' : '' }}">Informații produse</option>
                                <option value="order" {{ old('subject') == 'order' ? 'selected' : '' }}">Problemă comandă</option>
                                <option value="return" {{ old('subject') == 'return' ? 'selected' : '' }}">Returnare produs</option>
                                <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}">Parteneriate</option>
                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}">Altele</option>
                            </select>
                            @error('subject')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message">Mesaj *</label>
                            <textarea name="message" id="message" rows="6"
                                class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="consent" required>
                                <span>Sunt de acord cu prelucrarea datelor personale *</span>
                            </label>
                        </div>

                        <button type="submit" class="btn-primary btn-submit">Trimite mesaj</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="map-section">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45634.77457018092!2d26.084527!3d44.435322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b1ff5d3b7b9b9b%3A0x9b1b1b1b1b1b1b1b!2sBucharest!5e0!3m2!1sen!2sro!4v1234567890"
                width="100%"
                height="400"
                style="border:0; border-radius: 10px;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>
@endsection
