<?php

namespace App\Services\Stripe\Handlers;

use App\Services\Stripe\Handlers\RefundUpdated;

class ChargeRefundUpdated
{
    /**
     * Handle the `charge.refund.updated` event from Stripe.
     *
     * This function processes the refund object from the event payload and
     * delegates the handling to the RefundUpdated handler.
     *
     * @param object $event The Stripe event object containing the refund.
     *
     * @return void
     */

    public function handle(object $event): void
    {
        $refund = $event->refund ?? null;
        if ($refund) {
            app(RefundUpdated::class)->handle((object) $refund);
        }
    }
}
