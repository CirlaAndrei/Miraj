@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-icon">📦</div>
        <div class="stat-info">
            <h3>Total Produse</h3>
            <p>{{ $totalProducts }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📋</div>
        <div class="stat-info">
            <h3>Total Comenzi</h3>
            <p>{{ $totalOrders }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-info">
            <h3>Utilizatori</h3>
            <p>{{ $totalUsers }}</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-info">
            <h3>Vânzări totale</h3>
            <p>{{ number_format($totalRevenue, 0) }} RON</p>
        </div>
    </div>
</div>

<div class="recent-orders">
    <h2>Comenzi recente</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Status</th>
                <th>Data</th>
                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ number_format($order->total, 0) }} RON</td>
                <td>
                    <span class="badge badge-{{ $order->status === 'delivered' ? 'success' : 'warning' }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('d.m.Y') }}</td>
                <td>
                    <a href="#" class="btn-action btn-view">Vezi</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.stat-icon {
    font-size: 2.5rem;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px;
}

.stat-info h3 {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 5px;
}

.stat-info p {
    font-size: 1.8rem;
    font-weight: bold;
    color: #333;
}

.recent-orders {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.recent-orders h2 {
    margin-bottom: 20px;
    color: #333;
}

@media (max-width: 992px) {
    .dashboard-stats {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
@endsection
