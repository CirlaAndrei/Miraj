<!DOCTYPE html>
<html>
<head>
    <title>Comandă confirmată</title>
    <style>
        body { font-family: 'Poppins', Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
        .order-details { background: white; padding: 20px; border-radius: 5px; margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f0f0f0; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #e0e0e0; }
        .total { font-size: 1.2rem; font-weight: bold; color: #764ba2; text-align: right; margin-top: 20px; }
        .button { display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 25px; margin-top: 20px; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="header">
        <h1>✨ Miraj</h1>
        <p>Îți mulțumim pentru comandă!</p>
    </div>

    <div class="content">
        <h2>Bună {{ $order->user->name }},</h2>
        <p>Comanda ta <strong>#{{ $order->order_number }}</strong> a fost confirmată și este în procesare.</p>

        <div class="order-details">
            <h3>Detalii comandă</h3>
            <p><strong>Data:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Metodă plată:</strong> {{ $order->payment_method == 'card' ? 'Card bancar' : 'Ramburs' }}</p>
            <p><strong>Status plată:</strong> {{ $order->payment_status }}</p>

            <h4 style="margin-top: 20px;">Produse comandate:</h4>
            <table>
                <thead>
                    <tr>
                        <th>Produs</th>
                        <th>Cant.</th>
                        <th>Preț</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0) }} RON</td>
                        <td>{{ number_format($item->subtotal, 0) }} RON</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                <p><strong>Subtotal:</strong> {{ number_format($order->subtotal, 0) }} RON</p>
                <p><strong>Transport:</strong> {{ number_format($order->shipping, 0) }} RON</p>
                <p class="total">Total: {{ number_format($order->total, 0) }} RON</p>
            </div>

            <h4 style="margin-top: 20px;">Adresă livrare:</h4>
            <p>{{ $order->shipping_name }}</p>
            <p>{{ $order->shipping_phone }}</p>
            <p>{{ $order->shipping_address }}</p>
            <p>{{ $order->shipping_city }}, {{ $order->shipping_county }}</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('orders.show', $order) }}" class="button">Vezi comanda online</a>
        </div>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Miraj. Toate drepturile rezervate.</p>
    </div>
</body>
</html>
