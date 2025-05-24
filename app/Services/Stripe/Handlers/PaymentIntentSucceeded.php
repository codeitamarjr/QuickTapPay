<?php

namespace App\Services\Stripe\Handlers;

use App\Models\Sale;
use Illuminate\Support\Facades\Log;

class PaymentIntentSucceeded
{
    /**
     * Handle the `payment_intent.succeeded` event from Stripe.
     *
     * This function marks the associated Sale record as paid if it exists and
     * is not already marked as paid. It also logs the payment method used for
     * the transaction.
     *
     * @param object $intent The Stripe payment intent object.
     */
    public function handle(object $intent): void
    {
        $sale = Sale::where('stripe_payment_intent_id', $intent->id)->first();

        if ($sale && $sale->status !== 'paid') {
            $sale->update([
                'status' => 'paid',
                'payment_method' => $intent->payment_method_types[0] ?? 'card',
            ]);

            Log::info("Sale {$sale->id} marked as PAID via payment_intent.succeeded.");
        }
    }
}
