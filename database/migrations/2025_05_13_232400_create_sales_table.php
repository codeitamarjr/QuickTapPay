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

            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('payment_link_id')->constrained()->cascadeOnDelete();

            $table->decimal('amount', 10, 2)->index();
            $table->char('currency', 3)->default('EUR')->index();

            $table->string('name')->index();
            $table->string('email')->index();
            $table->string('phone')->index();
            $table->string('reference')->nullable()->index();

            $table->enum('status', ['pending', 'paid', 'failed', 'refunded', 'cancelled'])->default('pending')->index();
            $table->string('transaction_id', 36)->unique()->nullable();
            $table->string('payment_method')->default('card'); // 'card', 'paypal', 'bank_transfer'

            $table->string('stripe_session_id')->nullable()->unique();
            $table->string('stripe_payment_intent_id')->nullable()->unique();

            $table->fullText(['name', 'email', 'phone', 'reference', 'transaction_id']);
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
