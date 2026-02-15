@extends('admin.layouts.admin')

@section('title', 'Gestionare Comenzi')

@section('content')
<div class="orders-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Toate comenzile</h2>
    <div class="order-filters">
        <select id="status-filter" onchange="filterOrders()" style="padding: 8px; border-radius: 5px; border: 1px solid #e0e0e0;">
            <option value="">Toate statusurile</option>
            <option value="pending">În așteptare</option>
            <option value="processing">În procesare</option>
            <option value="shipped">Expediată</option>
            <option value="delivered">Livrată</option>
            <option value="cancelled">Anulată</option>
        </select>
    </div>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Număr comandă</th>
            <th>Client</th>
            <th>Total</th>
            <th>Status</th>
            <th>Plată</th>
            <th>Data</th>
            <th>Acțiuni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr class="order-row" data-status="{{ $order->status }}">
            <td>{{ $order->id }}</td>
            <td><strong>{{ $order->order_number }}</strong></td>
            <td>{{ $order->user->name }}</td>
            <td>{{ number_format($order->total, 0) }} RON</td>
            <td>
                <span class="badge" style="background:
                    @if($order->status == 'pending') #fff3cd; color: #856404;
                    @elseif($order->status == 'processing') #cce5ff; color: #004085;
                    @elseif($order->status == 'shipped') #d1ecf1; color: #0c5460;
                    @elseif($order->status == 'delivered') #d4edda; color: #155724;
                    @elseif($order->status == 'cancelled') #f8d7da; color: #721c24;
                    @endif padding: 5px 12px; border-radius: 15px;">
                    {{ $order->status }}
                </span>
            </td>
            <td>
                <span style="color: {{ $order->payment_status == 'paid' ? '#28a745' : '#856404' }}">
                    {{ $order->payment_status }}
                </span>
            </td>
            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
            <td>
                <a href="{{ route('admin.orders.show', $order) }}" class="btn-action btn-view">Vezi</a>
                <a href="{{ route('admin.orders.edit', $order) }}" class="btn-action btn-edit">Editează</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination" style="margin-top: 30px; display: flex; justify-content: center; gap: 5px;">
    {{ $orders->links() }}
</div>

<script>
function filterOrders() {
    const status = document.getElementById('status-filter').value;
    const rows = document.querySelectorAll('.order-row');

    rows.forEach(row => {
        if (status === '' || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>

<style>
    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        color: #333;
        text-decoration: none;
    }
    .pagination .active span {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }
</style>
@endsection
