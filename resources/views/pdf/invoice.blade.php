<!DOCTYPE html>
<html>
<head>
    <title>Factură #{{ $order->order_number }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; line-height: 1.4; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #764ba2; padding-bottom: 20px; }
        .header h1 { color: #764ba2; font-size: 2rem; margin: 0; }
        .company-info { margin-bottom: 30px; }
        .invoice-details { margin-bottom: 30px; }
        .invoice-details table { width: 100%; }
        .invoice-details td { padding: 5px; }
        .addresses { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .address-box { width: 45%; }
        .address-box h3 { background: #f0f0f0; padding: 10px; margin: 0 0 10px 0; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table.items th { background: #764ba2; color: white; padding: 10px; text-align: left; }
        table.items td { padding: 10px; border-bottom: 1px solid #e0e0e0; }
        table.items tr:last-child td { border-bottom: none; }
        .totals { text-align: right; margin-top: 20px; }
        .totals table { width: 300px; margin-left: auto; }
        .totals td { padding: 5px; }
        .grand-total { font-size: 1.2rem; font-weight: bold; color: #764ba2; }
        .footer { margin-top: 50px; text-align: center; color: #666; font-size: 10px; border-top: 1px solid #e0e0e0; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>✨ Miraj</h1>
        <p>Factură fiscală</p>
    </div>

    <div class="invoice-details">
        <table>
            <tr>
                <td><strong>Număr factură:</strong> INV-{{ $order->order_number }}</td>
                <td><strong>Data:</strong> {{ $order->created_at->format('d.m.Y') }}</td>
            </tr>
            <tr>
                <td><strong>Număr comandă:</strong> {{ $order->order_number }}</td>
                <td><strong>Status plată:</strong> {{ $order->payment_status }}</td>
            </tr>
        </table>
    </div>

    <div class="addresses">
        <div class="address-box">
            <h3>Date firmă</h3>
            <p><strong>Miraj SRL</strong></p>
            <p>Strada Exemplu, Nr. 123</p>
            <p>București, Sector 1</p>
            <p>Cod fiscal: RO12345678</p>
            <p>Reg. Com.: J40/12345/2024</p>
            <p>Email: contact@miraj.ro</p>
        </div>

        <div class="address-box">
            <h3>Date client</h3>
            <p><strong>{{ $order->shipping_name }}</strong></p>
            <p>{{ $order->shipping_phone }}</p>
            <p>{{ $order->shipping_address }}</p>
            <p>{{ $order->shipping_city }}, {{ $order->shipping_county }}</p>
            <p>Email: {{ $order->user->email }}</p>
        </div>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Produs</th>
                <th>Cantitate</th>
                <th>Preț unitar</th>
                <th>Valoare</th>
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

    <div class="totals">
        <table>
            <tr>
                <td>Subtotal:</td>
                <td>{{ number_format($order->subtotal, 0) }} RON</td>
            </tr>
            <tr>
                <td>Transport:</td>
                <td>{{ number_format($order->shipping, 0) }} RON</td>
            </tr>
            <tr class="grand-total">
                <td>TOTAL:</td>
                <td>{{ number_format($order->total, 0) }} RON</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Acest document este generat automat și nu necesită semnătură.</p>
        <p>© {{ date('Y') }} Miraj. Toate drepturile rezervate.</p>
    </div>
</body>
</html>
