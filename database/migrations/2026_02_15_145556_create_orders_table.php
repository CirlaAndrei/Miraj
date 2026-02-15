<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('pending');
            $table->string('payment_method')->nullable();

            // Shipping address
            $table->string('shipping_name');
            $table->string('shipping_phone');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_county');
            $table->string('shipping_postal_code')->nullable();

            // Billing address (if different)
            $table->boolean('same_as_shipping')->default(true);
            $table->string('billing_name')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_county')->nullable();
            $table->string('billing_postal_code')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
