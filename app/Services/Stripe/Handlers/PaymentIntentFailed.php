<?php

/**
 * File: PaymentIntentFailed.php
 * © 2025 Itamar Atanasio Da Silva Junior. All rights reserved.
 * This file is part of the Quick Tap Pay proprietary software.
 * Unauthorized copying or distribution of this file, via any medium, is strictly prohibited.
 */

namespace App\Services\Stripe\Handlers;

use App\Models\Sale;
use Illuminate\Support\Facades\Log;

class PaymentIntentFailed
{

    /**
     * Handles the `payment_intent.payment_failed` event from Stripe.
     *
     * This function marks the associated Sale record as failed if it exists and
     * is not already marked as failed. It also logs the failure for tracking
     * purposes.
     *
     * @param object $intent The Stripe payment intent object.
     */
    public function handle(object $intent): void
    {
        $sale = Sale::where('stripe_payment_intent_id', $intent->id)->first();

        if ($sale && $sale->status === 'pending') {
            $sale->update(['status' => 'failed']);

            Log::info("Sale {$sale->id} marked as FAILED via payment_intent.payment_failed.");
        }
    }
}
