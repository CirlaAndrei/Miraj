@extends('admin.layouts.admin')

@section('title', 'Adaugă Produs Nou')

@section('content')
<div class="admin-form">
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf

    <div class="form-group">
        <label for="image">Imagine produs *</label>
        <input type="file" name="image" id="image" accept="image/*"
            class="form-control @error('image') is-invalid @enderror" required>
        @error('image')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <small style="color: #666;">Acceptă JPG, PNG, GIF. Max 2MB.</small>
    </div>

        <div class="form-group">
            <label for="description">Descriere *</label>
            <textarea name="description" id="description" rows="6" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="price">Preț (RON) *</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" required>
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="sale_price">Preț redus (RON)</label>
                <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price') }}" step="0.01" min="0" class="form-control @error('sale_price') is-invalid @enderror">
                @error('sale_price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="sku">SKU (cod produs) *</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku') }}" class="form-control @error('sku') is-invalid @enderror" required>
                @error('sku')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock_quantity">Cantitate în stoc *</label>
                <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', 0) }}" min="0" class="form-control @error('stock_quantity') is-invalid @enderror" required>
                @error('stock_quantity')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="category">Categorie *</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                <option value="">Selectează categoria</option>
                <option value="Modă" {{ old('category') == 'Modă' ? 'selected' : '' }}>Modă</option>
                <option value="Accesorii" {{ old('category') == 'Accesorii' ? 'selected' : '' }}>Accesorii</option>
                <option value="Îngrijire" {{ old('category') == 'Îngrijire' ? 'selected' : '' }}>Îngrijire</option>
                <option value="Parfumuri" {{ old('category') == 'Parfumuri' ? 'selected' : '' }}>Parfumuri</option>
                <option value="Cadouri" {{ old('category') == 'Cadouri' ? 'selected' : '' }}>Cadouri</option>
            </select>
            @error('category')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">URL imagine *</label>
            <input type="url" name="image" id="image" value="{{ old('image') }}" class="form-control @error('image') is-invalid @enderror" required placeholder="https://...">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <small style="color: #666;">Folosește imagini de pe Unsplash, Pexels sau propriul tău server</small>
        </div>

        <div class="form-group">
            <label for="tags">Tag-uri (separate prin virgulă)</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control" placeholder="rochie, elegantă, vară">
        </div>

        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                <span>Produs recomandat (apare în secțiunea specială de pe homepage)</span>
            </label>
        </div>

        <div class="form-actions" style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn-primary" style="width: auto; padding: 12px 30px;">Salvează produsul</button>
            <a href="{{ route('admin.products.index') }}" class="btn-secondary" style="background: #f0f0f0; color: #333; padding: 12px 30px; border-radius: 5px; text-decoration: none;">Anulează</a>
        </div>
    </form>
</div>
@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            // Create preview element if it doesn't exist
            let preview = document.getElementById('image-preview');
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'image-preview';
                preview.style.maxWidth = '200px';
                preview.style.marginTop = '10px';
                preview.style.borderRadius = '5px';
                document.querySelector('.form-group:has(#image)').appendChild(preview);
            }
            preview.src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@stack('scripts')
@endsection
