<?php

namespace App\Services\Stripe\Handlers;

use App\Models\Sale;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutCompleted
{

    /**
     * Handle the `checkout.session.completed` event from Stripe.
     *
     * This function marks the associated Sale record as paid if it exists and
     * is not already marked as paid. It also logs the payment method used for
     * the transaction.
     *
     * @param object $session The Stripe checkout session object.
     */
    public function handle(object $session): void
    {
        Log::info("Webhook: checkout.session.completed for session {$session->id}");

        $sale = Sale::where('stripe_session_id', $session->id)->first();

        if ($sale && $sale->status !== 'paid') {
            $sale->update([
                'status' => 'paid',
                'stripe_payment_intent_id' => $session->payment_intent,
                'payment_method' => $session->payment_method_types[0] ?? 'card',
            ]);

            Mail::to($sale->email)->queue(new \App\Mail\SaleNotification($sale, 'paid'));

            Log::info("Sale {$sale->id} marked as PAID via webhook.");
        }
    }
}
