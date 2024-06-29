<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('order_status_id')->constrained('order_statuses');
            $table->foreignId('payment_id')->constrained('payments');
            $table->uuid('uuid');
            $table->json('products');
            $table->json('address');
            $table->double('delivery_fee')->nullable();
            $table->double('amount');
            $table->timestamps();
            $table->timestamp('shipped_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
