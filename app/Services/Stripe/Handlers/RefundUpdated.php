<?php

namespace App\Services\Stripe\Handlers;

use App\Models\Sale;
use Illuminate\Support\Facades\Log;

class RefundUpdated
{
    /**
     * Handle the `refund.updated` event from Stripe.
     *
     * This function reverts the associated Sale record back to PAID if the refund
     * is canceled or failed. This is to prevent a sale from being stuck in a
     * REFUNDED state if the refund fails or is canceled. If the refund is
     * successful, the sale record is left alone.
     *
     * @param object $refund The Stripe refund object.
     *
     * @return void
     */
    public function handle(object $refund): void
    {
        $paymentIntent = $refund->payment_intent ?? null;

        if (! $paymentIntent) return;

        $sale = Sale::where('stripe_payment_intent_id', $paymentIntent)->first();

        if (! $sale) return;

        if ($refund->status === 'canceled' || $refund->status === 'failed') {
            $sale->update(['status' => 'paid']);
            Log::info("Refund for Sale ID {$sale->id} was canceled or failed. Reverted to PAID.");
        }
    }
}
