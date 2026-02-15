<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Changed to file upload
            'tags' => 'nullable|string',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('public/products', $imageName);
            // Convert storage path to URL-friendly path
            $imageUrl = Storage::url($imagePath);
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity,
            'category' => $request->category,
            'image' => $imageUrl ?? null, // Store the URL path
            'tags' => $request->tags ? explode(',', $request->tags) : null,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produs adăugat cu succes!');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produs șters cu succes!');
    }
}
