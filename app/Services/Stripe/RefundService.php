<?php

/**
 * File: RefundService.php
 * © 2025 Itamar Atanasio Da Silva Junior. All rights reserved.
 * This file is part of the Quick Tap Pay proprietary software.
 * Unauthorized copying or distribution of this file, via any medium, is strictly prohibited.
 */

namespace App\Services\Stripe;

use App\Models\Sale;
use Stripe\StripeClient;
use App\Models\StripeEvent;
use Illuminate\Support\Facades\Log;

class RefundService
{
    public function process(Sale $sale, ?int $amountCents = null, string $reason = 'requested_by_customer'): void
    {
        Log::info("RefundService: Starting refund process for Sale ID {$sale->id}");

        $user = $sale->paymentLink->business->users()->wherePivot('role', 'admin')->first();
        if (! $user) {
            Log::error("RefundService: No admin user found for Sale ID {$sale->id}");
            return;
        }

        $accountId = $user->stripe_account_id;
        if (! $accountId) {
            Log::error("RefundService: No stripe_account_id for user {$user->id}");
            return;
        }

        Log::info("RefundService: Initiating Stripe refund for payment_intent={$sale->stripe_payment_intent_id}, account={$accountId}");

        try {
            $stripe = new StripeClient(config('services.stripe.secret'));

            $refundData = [
                'payment_intent' => $sale->stripe_payment_intent_id,
                'reason' => $reason,
                'refund_application_fee' => true,
                'reverse_transfer' => true,
            ];

            if (!is_null($amountCents)) {
                $refundData['amount'] = $amountCents;
            }

            $refund = $stripe->refunds->create($refundData);

            Log::info("RefundService: Refund created successfully", [
                'refund_id' => $refund->id,
                'sale_id' => $sale->id,
                'user_id' => $user->id,
            ]);

            $sale->update(['status' => 'refunded']);

            StripeEvent::create([
                'user_id' => $user->id,
                'event_type' => 'refund.created',
                'stripe_account_id' => $accountId,
                'object_id' => $refund->id,
                'object_type' => 'refund',
                'payload' => $refund->toArray(),
            ]);
        } catch (\Exception $e) {
            Log::error("RefundService: Refund failed for Sale ID {$sale->id}", [
                'error' => $e->getMessage(),
                'payment_intent' => $sale->stripe_payment_intent_id,
                'user_id' => $user->id ?? null,
                'stripe_account_id' => $accountId ?? null,
            ]);
            throw $e; // rethrow if needed for UI error display
        }
    }
}
