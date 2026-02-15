@extends('admin.layouts.admin')

@section('title', 'Detalii Comandă #' . $order->order_number)

@section('content')
<div class="order-details">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Comandă #{{ $order->order_number }}</h2>
        <a href="{{ route('admin.orders.index') }}" style="background: #f0f0f0; color: #333; padding: 10px 20px; border-radius: 5px; text-decoration: none;">← Înapoi la comenzi</a>
    </div>

    <!-- Status Update Form -->
    <div style="background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.orders.update', $order) }}" method="POST" style="display: flex; gap: 20px; align-items: flex-end;">
            @csrf
            @method('PUT')
            <div style="flex: 1;">
                <label for="status" style="display: block; margin-bottom: 5px; font-weight: 500;">Actualizează statusul comenzii:</label>
                <select name="status" id="status" style="width: 100%; padding: 10px; border: 1px solid #e0e0e0; border-radius: 5px;">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>În așteptare</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>În procesare</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Expediată</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Livrată</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Anulată</option>
                </select>
            </div>
            <button type="submit" class="btn-primary" style="padding: 10px 30px;">Actualizează</button>
        </form>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
        <!-- Customer Info -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">Informații client</h3>
            <p><strong>Nume:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Telefon:</strong> {{ $order->shipping_phone }}</p>
        </div>

        <!-- Order Summary -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">Sumar comandă</h3>
            <p><strong>Subtotal:</strong> {{ number_format($order->subtotal, 0) }} RON</p>
            <p><strong>Transport:</strong> {{ number_format($order->shipping, 0) }} RON</p>
            <p><strong>Total:</strong> {{ number_format($order->total, 0) }} RON</p>
            <p><strong>Metodă plată:</strong> {{ $order->payment_method == 'card' ? 'Card bancar' : 'Ramburs' }}</p>
            <p><strong>Status plată:</strong>
                <span style="color: {{ $order->payment_status == 'paid' ? '#28a745' : '#856404' }}">
                    {{ $order->payment_status }}
                </span>
            </p>
        </div>
    </div>

    <!-- Shipping Address -->
    <div style="background: white; padding: 25px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">Adresă livrare</h3>
        <p>{{ $order->shipping_name }}</p>
        <p>{{ $order->shipping_phone }}</p>
        <p>{{ $order->shipping_address }}</p>
        <p>{{ $order->shipping_city }}, {{ $order->shipping_county }}</p>
        @if($order->shipping_postal_code)
            <p>Cod poștal: {{ $order->shipping_postal_code }}</p>
        @endif
    </div>

    <!-- Order Items -->
    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">Produse comandate</h3>

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
            <tfoot>
                <tr>
                    <td colspan="3" style="padding: 12px; text-align: right;"><strong>Total:</strong></td>
                    <td style="padding: 12px; text-align: right;"><strong>{{ number_format($order->total, 0) }} RON</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    @if($order->notes)
    <div style="background: #f9f9f9; padding: 20px; border-radius: 10px; margin-top: 30px;">
        <h4 style="margin-bottom: 10px;">Observații client:</h4>
        <p>{{ $order->notes }}</p>
    </div>
    @endif
</div>
@endsection
