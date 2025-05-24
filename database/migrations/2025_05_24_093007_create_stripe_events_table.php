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
        Schema::create('stripe_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('event_type');
            $table->string('stripe_account_id')->nullable();
            $table->string('object_id')->nullable(); // e.g. pi_..., ch_..., acct_...
            $table->string('object_type')->nullable(); // e.g. payment_intent, charge, account
            $table->json('payload')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_events');
    }
};
