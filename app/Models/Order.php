<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'shipping',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_county',
        'shipping_postal_code',
        'same_as_shipping',
        'billing_name',
        'billing_phone',
        'billing_address',
        'billing_city',
        'billing_county',
        'billing_postal_code',
        'notes',
    ];

    protected $casts = [
        'same_as_shipping' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
