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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('business_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_link_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->string('currency')->default('EUR');
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('reference')->nullable();
            $table->string('status')->default('pending'); // 'pending', 'paid', 'failed'
            $table->string('transaction_id')->nullable();
            $table->string('payment_method')->default('card'); // 'card', 'paypal', 'bank_transfer'
            $table->string('stripe_session_id')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
