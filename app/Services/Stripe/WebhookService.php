<?php

namespace App\Services\Stripe;

use App\Models\User;
use App\Models\StripeEvent;
use Illuminate\Support\Facades\Log;

class WebhookService
{
    /**
     * Handle a Stripe webhook event.
     *
     * @param string $eventType The type of webhook event, e.g. "checkout.session.completed".
     * @param object $payload The payload of the webhook event.
     *
     * @return void
     */
    public function handle(string $eventType, object $payload): void
    {
        $user = null;
        $stripeAccountId = $payload->account ?? null;

        if ($stripeAccountId) {
            $user = User::where('stripe_account_id', $stripeAccountId)->first();
        }

        StripeEvent::create([
            'user_id' => $user?->id,
            'event_type' => $eventType,
            'stripe_account_id' => $stripeAccountId,
            'object_id' => $payload->id ?? null,
            'object_type' => $payload->object ?? null,
            'payload' => (array) $payload,
        ]);

        match ($eventType) {
            'checkout.session.completed' => app(Handlers\CheckoutCompleted::class)->handle($payload),
            'checkout.session.expired' => app(Handlers\SessionExpired::class)->handle($payload),
            'payment_intent.succeeded' => app(Handlers\PaymentIntentSucceeded::class)->handle($payload),
            'payment_intent.payment_failed' => app(Handlers\PaymentIntentFailed::class)->handle($payload),
            'charge.refunded' => app(Handlers\ChargeRefunded::class)->handle($payload),
            'account.updated' => app(Handlers\AccountUpdated::class)->handle($payload),
            'capability.updated' => app(Handlers\CapabilityUpdated::class)->handle($payload),
            default => Log::debug("Ignoring event: {$eventType}"),
        };
    }
}
