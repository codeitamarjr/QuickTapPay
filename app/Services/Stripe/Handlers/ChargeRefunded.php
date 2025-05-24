<?php

namespace App\Services\Stripe\Handlers;

use App\Models\Sale;
use Illuminate\Support\Facades\Log;

class ChargeRefunded
{

    /**
     * Handles the `charge.refunded` event from Stripe.
     *
     * This function marks any associated Sale records as refunded if the sale
     * is currently marked as paid, and logs the refund for tracking
     * purposes.
     *
     * @param object $charge The Stripe charge object.
     */
    public function handle(object $charge): void
    {
        $paymentIntentId = $charge->payment_intent ?? null;

        if (! $paymentIntentId) {
            Log::warning("Refund webhook received without payment_intent ID.");
            return;
        }

        $sale = Sale::where('stripe_payment_intent_id', $paymentIntentId)->first();

        if ($sale && $sale->status !== 'refunded') {
            $sale->update([
                'status' => 'refunded',
            ]);

            Log::info("Sale {$sale->id} marked as REFUNDED via webhook.");
        }
    }
}
