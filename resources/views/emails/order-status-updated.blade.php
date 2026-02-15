<!DOCTYPE html>
<html>
<head>
    <title>Status comandă actualizat</title>
    <style>
        body { font-family: 'Poppins', Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
        .status-box { background: white; padding: 20px; border-radius: 5px; margin: 20px 0; text-align: center; }
        .status { font-size: 1.5rem; font-weight: bold; padding: 10px 20px; border-radius: 30px; display: inline-block; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.processing { background: #cce5ff; color: #004085; }
        .status.shipped { background: #d1ecf1; color: #0c5460; }
        .status.delivered { background: #d4edda; color: #155724; }
        .status.cancelled { background: #f8d7da; color: #721c24; }
        .button { display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 25px; margin-top: 20px; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="header">
        <h1>✨ Miraj</h1>
        <p>Actualizare status comandă</p>
    </div>

    <div class="content">
        <h2>Bună {{ $order->user->name }},</h2>
        <p>Statusul comenzii tale <strong>#{{ $order->order_number }}</strong> a fost actualizat.</p>

        <div class="status-box">
            <p>Status nou:</p>
            <div class="status {{ $order->status }}">
                @switch($order->status)
                    @case('pending') În așteptare @break
                    @case('processing') În procesare @break
                    @case('shipped') Expediată @break
                    @case('delivered') Livrată @break
                    @case('cancelled') Anulată @break
                    @default {{ $order->status }}
                @endswitch
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('orders.show', $order) }}" class="button">Vezi detalii comandă</a>
        </div>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Miraj. Toate drepturile rezervate.</p>
    </div>
</body>
</html>
