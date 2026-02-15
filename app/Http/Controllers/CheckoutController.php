<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\OrderConfirmation;
use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;
class CheckoutController extends Controller  // Make sure it extends Controller
{

    // Show checkout page
    public function index()
    {
        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Coșul tău este gol!');
        }

        $subtotal = $cartItems->sum('subtotal');
        $shipping = 20; // Fixed shipping cost for now
        $total = $subtotal + $shipping;

        // Get user's addresses for selection
        $addresses = Auth::user()->addresses;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'total', 'addresses'));
    }

    // Process the order
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|exists:addresses,id',
            'same_as_shipping' => 'boolean',
            'billing_address_id' => 'required_if:same_as_shipping,false|exists:addresses,id',
            'payment_method' => 'required|in:card,ramburs',
            'notes' => 'nullable|string|max:500',
        ]);

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Coșul tău este gol!');
        }

        // Get addresses
        $shippingAddress = Auth::user()->addresses()->findOrFail($request->shipping_address_id);

        if ($request->same_as_shipping) {
            $billingAddress = $shippingAddress;
        } else {
            $billingAddress = Auth::user()->addresses()->findOrFail($request->billing_address_id);
        }

        $subtotal = $cartItems->sum('subtotal');
        $shipping = 20; // Fixed shipping cost
        $total = $subtotal + $shipping;

        // Create order in database transaction
        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => $request->payment_method === 'card' ? 'pending' : 'awaiting',
                'payment_method' => $request->payment_method,

                // Shipping address
                'shipping_name' => $shippingAddress->recipient_name,
                'shipping_phone' => $shippingAddress->phone,
                'shipping_address' => $shippingAddress->address_line1 . ($shippingAddress->address_line2 ? ', ' . $shippingAddress->address_line2 : ''),
                'shipping_city' => $shippingAddress->city,
                'shipping_county' => $shippingAddress->county,
                'shipping_postal_code' => $shippingAddress->postal_code,

                // Billing address
                'same_as_shipping' => $request->same_as_shipping,
                'billing_name' => $billingAddress->recipient_name,
                'billing_phone' => $billingAddress->phone,
                'billing_address' => $billingAddress->address_line1 . ($billingAddress->address_line2 ? ', ' . $billingAddress->address_line2 : ''),
                'billing_city' => $billingAddress->city,
                'billing_county' => $billingAddress->county,
                'billing_postal_code' => $billingAddress->postal_code,

                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->name,
                    'price' => $cartItem->product->display_price,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $cartItem->subtotal,
                ]);

                // Update product stock
                $cartItem->product->decrement('stock_quantity', $cartItem->quantity);
            }
            // After creating the order and before clearing cart
if ($request->payment_method === 'card') {
    // For card payments, redirect to Stripe
    DB::commit();
    return redirect()->route('stripe.checkout', $order);
} else {
    // For cash on delivery, complete order normally
    DB::commit();

    // Send confirmation email
    Mail::to($order->user->email)->send(new OrderConfirmation($order));

    return redirect()->route('checkout.success', $order);
}

            // Clear the cart
            $userId = Auth::id();
            $sessionId = session()->get('cart_session_id');

            Cart::where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->delete();

            DB::commit();
           Mail::to($order->user->email)->send(new OrderConfirmation($order));


            // Redirect to success page
            return redirect()->route('checkout.success', $order);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'A apărut o eroare. Te rugăm să încerci din nou.');
        }
    }

    // Show order success page
    public function success(Order $order)
    {
        // Make sure the order belongs to the logged in user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }

    // Helper: Get cart items
    private function getCartItems()
    {
        $userId = Auth::id();
        $sessionId = session()->get('cart_session_id');

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
}
