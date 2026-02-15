<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StripePaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Initiate checkout for an order
     */
    public function checkout(Order $order)
    {
        // Verify order belongs to user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if order is already paid
        if ($order->payment_status === 'paid' || $order->paid_at) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Această comandă a fost deja plătită.');
        }

        // Prepare items for Stripe
        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                'name' => $item->product_name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'description' => 'SKU: ' . ($item->product->sku ?? 'N/A'),
            ];
        }

        // Add shipping as a line item
        if ($order->shipping > 0) {
            $items[] = [
                'name' => 'Transport',
                'price' => $order->shipping,
                'quantity' => 1,
                'description' => 'Cost livrare',
            ];
        }

        // Create Stripe checkout session
        $result = $this->stripeService->createCheckoutSession(
            $items,
            $order->id,
            route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            route('stripe.cancel')
        );

        if (!$result['success']) {
            Log::error('Stripe checkout failed', [
                'order_id' => $order->id,
                'error' => $result['error']
            ]);

            return back()->with('error', 'A apărut o eroare la procesarea plății. Te rugăm să încerci din nou.');
        }

        // Save session ID to order
        $order->stripe_session_id = $result['session_id'];
        $order->save();

        // Redirect to Stripe Checkout
        return redirect($result['session_url']);
    }

    /**
     * Handle successful payment
     */
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('home')->with('error', 'ID-ul sesiunii lipsește.');
        }

        // Retrieve session details
        $result = $this->stripeService->retrieveSession($sessionId);

        if (!$result['success']) {
            return redirect()->route('home')->with('error', 'Nu s-au putut verifica detaliile plății.');
        }

        $session = $result['session'];
        $orderId = $session->metadata->order_id ?? null;

        if (!$orderId) {
            return redirect()->route('home')->with('error', 'Comanda nu a fost găsită.');
        }

        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Comanda nu a fost găsită.');
        }

        // Verify order belongs to user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Update order payment status
        $order->payment_status = 'paid';
        $order->payment_intent_id = $session->payment_intent;
        $order->paid_at = now();
        $order->save();

        return view('payment.success', compact('order'));
    }

    /**
     * Handle cancelled payment
     */
    public function cancel(Request $request)
    {
        return view('payment.cancel');
    }
}
