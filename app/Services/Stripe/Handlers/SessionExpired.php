<?php

/**
 * File: SessionExpired.php
 * © 2025 Itamar Atanasio Da Silva Junior. All rights reserved.
 * This file is part of the Quick Tap Pay proprietary software.
 * Unauthorized copying or distribution of this file, via any medium, is strictly prohibited.
 */

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
