<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products',
            'stock_quantity' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'required|url',
            'tags' => 'nullable|string',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity,
            'category' => $request->category,
            'image' => $request->image,
            'tags' => $request->tags ? explode(',', $request->tags) : null,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produs adăugat cu succes!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'stock_quantity' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'required|url',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity,
            'category' => $request->category,
            'image' => $request->image,
            'tags' => $request->tags ? explode(',', $request->tags) : null,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produs actualizat cu succes!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produs șters cu succes!');
    }
}
