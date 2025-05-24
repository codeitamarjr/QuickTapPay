<?php

namespace App\Services\Stripe\Handlers;

use App\Services\Stripe\Handlers\RefundUpdated;

class RefundFailed
{
    /**
     * Handle the `refund.failed` event from Stripe.
     *
     * This function delegates to RefundUpdated::handle to handle this event.
     *
     * @param object $refund The Stripe refund object.
     *
     * @return void
     */
    public function handle(object $refund): void
    {
        app(RefundUpdated::class)->handle($refund);
    }
}
