@extends('layouts.app')

@section('content')
<div class="container">
    <div style="max-width: 1000px; margin: 40px auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1>Detalii Comandă #{{ $order->order_number }}</h1>
            <a href="{{ route('profile') }}#orders" style="color: #764ba2; text-decoration: none;">← Înapoi la comenzile mele</a>
        </div>

        <!-- Order Status -->
        <div style="background: white; border-radius: 10px; padding: 30px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3>Status comandă</h3>
                    <span style="display: inline-block; padding: 5px 15px; border-radius: 20px; background:
                        @if($order->status == 'pending') #fff3cd; color: #856404;
                        @elseif($order->status == 'processing') #cce5ff; color: #004085;
                        @elseif($order->status == 'shipped') #d1ecf1; color: #0c5460;
                        @elseif($order->status == 'delivered') #d4edda; color: #155724;
                        @elseif($order->status == 'cancelled') #f8d7da; color: #721c24;
                        @endif">
                        {{ $order->status }}
                    </span>
                </div>
                <div>
                    <h3>Status plată</h3>
                    <span style="color: {{ $order->payment_status == 'paid' ? '#28a745' : '#856404' }}">
                        {{ $order->payment_status }}
                    </span>
                </div>
                <div>
                    <h3>Data comenzii</h3>
                    <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
            <!-- Shipping Address -->
            <div style="background: white; border-radius: 10px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 15px;">Adresă livrare</h3>
                <p><strong>{{ $order->shipping_name }}</strong></p>
                <p>{{ $order->shipping_phone }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->shipping_city }}, {{ $order->shipping_county }}</p>
                @if($order->shipping_postal_code)
                    <p>Cod poștal: {{ $order->shipping_postal_code }}</p>
                @endif
            </div>

            <!-- Order Summary -->
            <div style="background: white; border-radius: 10px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 15px;">Sumar comandă</h3>
                <table style="width: 100%;">
                    <tr>
                        <td style="padding: 5px 0;">Subtotal:</td>
                        <td style="padding: 5px 0; text-align: right;">{{ number_format($order->subtotal, 0) }} RON</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0;">Transport:</td>
                        <td style="padding: 5px 0; text-align: right;">{{ number_format($order->shipping, 0) }} RON</td>
                    </tr>
                    <tr style="font-weight: bold; border-top: 2px solid #f0f0f0;">
                        <td style="padding: 15px 0 5px;">Total:</td>
                        <td style="padding: 15px 0 5px; text-align: right;">{{ number_format($order->total, 0) }} RON</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Order Items -->
        <div style="background: white; border-radius: 10px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 20px;">Produse comandate</h3>

            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f5f5f5;">
                        <th style="padding: 12px; text-align: left;">Produs</th>
                        <th style="padding: 12px; text-align: center;">Preț</th>
                        <th style="padding: 12px; text-align: center;">Cantitate</th>
                        <th style="padding: 12px; text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td style="padding: 12px;">{{ $item->product_name }}</td>
                        <td style="padding: 12px; text-align: center;">{{ number_format($item->price, 0) }} RON</td>
                        <td style="padding: 12px; text-align: center;">{{ $item->quantity }}</td>
                        <td style="padding: 12px; text-align: right;">{{ number_format($item->subtotal, 0) }} RON</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($order->notes)
                <div style="margin-top: 30px; padding: 20px; background: #f9f9f9; border-radius: 5px;">
                    <h4>Observații:</h4>
                    <p>{{ $order->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
