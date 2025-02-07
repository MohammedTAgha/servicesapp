<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Foreign key to orders
            $table->decimal('amount', 8, 2); // Payment amount
            $table->string('status')->default('pending'); // Payment status (e.g., pending, completed, failed)
            $table->string('payment_method'); // Payment method (e.g., credit card, PayPal)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
