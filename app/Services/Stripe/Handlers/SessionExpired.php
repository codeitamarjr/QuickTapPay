<?php

namespace App\Services\Stripe\Handlers;

use App\Models\Sale;
use Illuminate\Support\Facades\Log;

class SessionExpired
{

    /**
     * Handle the `checkout.session.expired` event from Stripe.
     *
     * This function marks the associated Sale record as failed if the sale
     * is currently marked as pending, and logs the failure for tracking
     * purposes.
     *
     * @param object $session The Stripe checkout session object.
     */
    public function handle(object $session): void
    {
        Log::info("Webhook: checkout.session.expired for session {$session->id}");

        $sale = Sale::where('stripe_session_id', $session->id)->first();

        if ($sale && $sale->status === 'pending') {
            $sale->update(['status' => 'failed']);

            Log::info("Sale {$sale->id} marked as FAILED due to expired session.");
        }
    }
}
