<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Exception;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        Stripe::setApiVersion('2024-11-20.acacia'); // Use stable version
    }

    /**
     * Create a Stripe Checkout Session
     */
    public function createCheckoutSession($items, $orderId, $successUrl, $cancelUrl)
    {
        try {
            $lineItems = [];

            foreach ($items as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'ron',
                        'product_data' => [
                            'name' => $item['name'],
                            'description' => $item['description'] ?? null,
                        ],
                        'unit_amount' => $item['price'] * 100, // Stripe uses cents
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'metadata' => [
                    'order_id' => $orderId,
                ],
            ]);

            return [
                'success' => true,
                'session_id' => $session->id,
                'session_url' => $session->url,
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Retrieve session details
     */
    public function retrieveSession($sessionId)
    {
        try {
            $session = Session::retrieve($sessionId);
            return [
                'success' => true,
                'session' => $session,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
