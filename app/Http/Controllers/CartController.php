<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Get or create session ID for guest users
    private function getSessionId()
    {
        if (!session()->has('cart_session_id')) {
            session()->put('cart_session_id', Str::random(40));
        }
        return session()->get('cart_session_id');
    }

    // Show cart page
    public function index()
    {
        $cartItems = $this->getCartItems();
        $subtotal = $cartItems->sum('subtotal');

        return view('cart.index', compact('cartItems', 'subtotal'));
    }

    // Add item to cart
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock_quantity,
        ]);

        $userId = Auth::id();
        $sessionId = $this->getSessionId();

        // Check if item already in cart
        $cartItem = Cart::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produsul a fost adăugat în coș!');
    }

    // Update cart item quantity
    public function update(Request $request, Cart $cart)
    {
        // Check if cart belongs to current user/session
        if (!$this->cartBelongsToUser($cart)) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->stock_quantity,
        ]);

        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Coșul a fost actualizat!');
    }

    // Remove item from cart
    public function remove(Cart $cart)
    {
        if (!$this->cartBelongsToUser($cart)) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Produsul a fost eliminat din coș!');
    }

    // Clear entire cart
    public function clear()
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();

        Cart::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();

        return redirect()->route('cart.index')->with('success', 'Coșul a fost golit!');
    }

    // Helper: Get cart items
    private function getCartItems()
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();

        return Cart::with('product')
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->get();
    }

    // Helper: Check if cart belongs to current user/session
    private function cartBelongsToUser($cart)
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();

        if ($userId) {
            return $cart->user_id === $userId;
        }
        return $cart->session_id === $sessionId;
    }
}
