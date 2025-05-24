<?php

/**
 * File: RefundFailed.php
 * © 2025 Itamar Atanasio Da Silva Junior. All rights reserved.
 * This file is part of the Quick Tap Pay proprietary software.
 * Unauthorized copying or distribution of this file, via any medium, is strictly prohibited.
 */

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
