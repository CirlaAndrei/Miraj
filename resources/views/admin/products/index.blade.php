@extends('admin.layouts.admin')

@section('title', 'Gestionare Produse')

@section('content')
<a href="{{ route('admin.products.create') }}" class="btn-add">+ Adaugă produs nou</a>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagine</th>
            <th>Nume</th>
            <th>Categorie</th>
            <th>Preț</th>
            <th>Stoc</th>
            <th>Acțiuni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>
                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ number_format($product->price, 0) }} RON</td>
            <td>
                <span class="badge {{ $product->stock_quantity > 0 ? 'badge-success' : 'badge-danger' }}">
                    {{ $product->stock_quantity }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn-action btn-edit">Editează</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Ești sigur?')">Șterge</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
