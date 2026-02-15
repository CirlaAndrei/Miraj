@extends('admin.layouts.admin')

@section('title', 'Editează Comandă #' . $order->order_number)

@section('content')
<div class="order-edit">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Editează Comandă #{{ $order->order_number }}</h2>
        <a href="{{ route('admin.orders.show', $order) }}" style="background: #f0f0f0; color: #333; padding: 10px 20px; border-radius: 5px; text-decoration: none;">← Înapoi</a>
    </div>

    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div>
                    <h3 style="margin-bottom: 20px;">Status comandă</h3>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>În așteptare</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>În procesare</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Expediată</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Livrată</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Anulată</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment_status">Status plată:</label>
                        <select name="payment_status" id="payment_status" class="form-control">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>În așteptare</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Plătit</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Eșuat</option>
                            <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Ramursat</option>
                        </select>
                    </div>
                </div>

                <div>
                    <h3 style="margin-bottom: 20px;">Informații livrare</h3>
                    <div class="form-group">
                        <label for="tracking_number">Număr de tracking (AWB):</label>
                        <input type="text" name="tracking_number" id="tracking_number" class="form-control" value="{{ $order->tracking_number ?? '' }}">
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn-primary">Salvează modificările</button>
            </div>
        </form>
    </div>
</div>
@endsection
