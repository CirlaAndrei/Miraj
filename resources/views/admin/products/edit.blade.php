@extends('admin.layouts.admin')

@section('title', 'Editează Produs')

@section('content')
<div class="admin-form">
    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nume produs *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descriere *</label>
            <textarea name="description" id="description" rows="6" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="price">Preț (RON) *</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" required>
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="sale_price">Preț redus (RON)</label>
                <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01" min="0" class="form-control @error('sale_price') is-invalid @enderror">
                @error('sale_price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="sku">SKU (cod produs) *</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" class="form-control @error('sku') is-invalid @enderror" required>
                @error('sku')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock_quantity">Cantitate în stoc *</label>
                <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" class="form-control @error('stock_quantity') is-invalid @enderror" required>
                @error('stock_quantity')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="category">Categorie *</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                <option value="">Selectează categoria</option>
                <option value="Modă" {{ (old('category', $product->category) == 'Modă') ? 'selected' : '' }}>Modă</option>
                <option value="Accesorii" {{ (old('category', $product->category) == 'Accesorii') ? 'selected' : '' }}>Accesorii</option>
                <option value="Îngrijire" {{ (old('category', $product->category) == 'Îngrijire') ? 'selected' : '' }}>Îngrijire</option>
                <option value="Parfumuri" {{ (old('category', $product->category) == 'Parfumuri') ? 'selected' : '' }}>Parfumuri</option>
                <option value="Cadouri" {{ (old('category', $product->category) == 'Cadouri') ? 'selected' : '' }}>Cadouri</option>
            </select>
            @error('category')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">URL imagine *</label>
            <input type="url" name="image" id="image" value="{{ old('image', $product->image) }}" class="form-control @error('image') is-invalid @enderror" required>
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <div style="margin-top: 10px;">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="max-width: 200px; max-height: 200px; border-radius: 5px;">
            </div>
        </div>

        <div class="form-group">
            <label for="tags">Tag-uri (separate prin virgulă)</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags', is_array($product->tags) ? implode(',', $product->tags) : $product->tags) }}" class="form-control">
        </div>

        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                <span>Produs recomandat</span>
            </label>
        </div>

        <div class="form-actions" style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn-primary" style="width: auto; padding: 12px 30px;">Actualizează produsul</button>
            <a href="{{ route('admin.products.index') }}" class="btn-secondary" style="background: #f0f0f0; color: #333; padding: 12px 30px; border-radius: 5px; text-decoration: none;">Anulează</a>
        </div>
    </form>
</div>
@endsection
