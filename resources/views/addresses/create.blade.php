@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card" style="max-width: 600px;">
        <h2>Adaugă adresă nouă</h2>

        <form method="POST" action="{{ route('addresses.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nume adresă (opțional)</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="form-control" placeholder="Acasă, Birou, etc.">
            </div>

            <div class="form-group">
                <label for="recipient_name">Nume destinatar *</label>
                <input type="text" name="recipient_name" id="recipient_name" value="{{ old('recipient_name') }}"
                    class="form-control @error('recipient_name') is-invalid @enderror" required>
                @error('recipient_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Telefon *</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                    class="form-control @error('phone') is-invalid @enderror" required>
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address_line1">Adresa *</label>
                <input type="text" name="address_line1" id="address_line1" value="{{ old('address_line1') }}"
                    class="form-control @error('address_line1') is-invalid @enderror" required>
                @error('address_line1')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address_line2">Adresa (linia 2) - opțional</label>
                <input type="text" name="address_line2" id="address_line2" value="{{ old('address_line2') }}"
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="city">Oraș *</label>
                <input type="text" name="city" id="city" value="{{ old('city') }}"
                    class="form-control @error('city') is-invalid @enderror" required>
                @error('city')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="county">Județ *</label>
                <input type="text" name="county" id="county" value="{{ old('county') }}"
                    class="form-control @error('county') is-invalid @enderror" required>
                @error('county')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="postal_code">Cod poștal</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                    class="form-control">
            </div>

            <button type="submit" class="btn-primary">Salvează adresa</button>
            <a href="{{ route('profile') }}" class="btn-link" style="display: block; text-align: center; margin-top: 10px;">Anulează</a>
        </form>
    </div>
</div>
@endsection
