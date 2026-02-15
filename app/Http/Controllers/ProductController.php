<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
                                   ->where('is_published', true)
                                   ->limit(4)
                                   ->get();

        $newProducts = Product::where('is_published', true)
                              ->latest()
                              ->limit(4)
                              ->get();

        return view('home', compact('featuredProducts', 'newProducts'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
                          ->where('is_published', true)
                          ->firstOrFail();

        $relatedProducts = Product::where('category', $product->category)
                                  ->where('id', '!=', $product->id)
                                  ->where('is_published', true)
                                  ->limit(4)
                                  ->get();

        return view('product', compact('product', 'relatedProducts'));
    }
}
