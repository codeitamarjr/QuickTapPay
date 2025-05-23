<?php

namespace App\Services\Stripe;

use App\Models\Sale;
use Illuminate\Support\Facades\Log;

class WebhookService
{
    public function handle(string $eventType, object $payload): void
    {
        match ($eventType) {
            'checkout.session.completed' => $this->handleCheckoutCompleted($payload),
            'checkout.session.expired' => $this->handleSessionExpired($payload),
            'payment_intent.succeeded' => $this->handlePaymentIntentSucceeded($payload),
            'payment_intent.payment_failed' => $this->handlePaymentIntentFailed($payload),
            'charge.refunded' => $this->handleChargeRefunded($payload),
            'account.updated' => $this->handleAccountUpdated($payload),
            'capability.updated' => $this->handleCapabilityUpdated($payload),
            default => Log::debug("Ignoring event: {$eventType}"),
        };
    }

    /**
     * Handles the `payment_intent.succeeded` event from Stripe.
     *
     * This function updates the corresponding Sale record to mark it as paid
     * if it exists and is not already marked as paid. It also logs the payment
     * method used for the transaction.
     *
     * @param object $intent The Stripe payment intent object.
     */

    protected function handlePaymentIntentSucceeded(object $intent): void
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

    /**
     * Handles the `payment_intent.payment_failed` event from Stripe.
     *
     * This function updates the corresponding Sale record to mark it as failed
     * if the sale exists and is currently marked as pending. It logs the 
     * failure for tracking purposes.
     *
     * @param object $intent The Stripe payment intent object.
     */

    protected function handlePaymentIntentFailed(object $intent): void
    {
        $sale = Sale::where('stripe_payment_intent_id', $intent->id)->first();

        if ($sale && $sale->status === 'pending') {
            $sale->update(['status' => 'failed']);

            Log::info("Sale {$sale->id} marked as FAILED via payment_intent.payment_failed.");
        }
    }

    /**
     * Handles the `checkout.session.completed` event from Stripe.
     *
     * This function updates the corresponding Sale record to mark it as paid
     * if it exists and is not already marked as paid. It also logs the payment
     * method used for the transaction.
     *
     * @param object $session The Stripe checkout session object.
     */
    protected function handleCheckoutCompleted(object $session): void
    {
        Log::info("Webhook: checkout.session.completed for session {$session->id}");

        $sale = Sale::where('stripe_session_id', $session->id)->first();

        if ($sale && $sale->status !== 'paid') {
            $sale->update([
                'status' => 'paid',
                'payment_method' => $session->payment_method_types[0] ?? 'card',
            ]);

            Log::info("Sale {$sale->id} marked as PAID via webhook.");
        }
    }

    /**
     * Handles the `checkout.session.expired` event from Stripe.
     *
     * This function marks any associated Sale records as failed if the sale
     * is currently marked as pending, and logs the failure for tracking
     * purposes.
     *
     * @param object $session The Stripe checkout session object.
     */
    protected function handleSessionExpired(object $session): void
    {
        Log::info("Webhook: checkout.session.expired for session {$session->id}");

        $sale = Sale::where('stripe_session_id', $session->id)->first();

        if ($sale && $sale->status === 'pending') {
            $sale->update(['status' => 'failed']);

            Log::info("Sale {$sale->id} marked as FAILED due to expired session.");
        }
    }

    /**
     * Handles the `charge.refunded` event from Stripe.
     *
     * This function marks any associated Sale records as refunded if the sale
     * is currently marked as paid, and logs the refund for tracking
     * purposes.
     *
     * @param object $charge The Stripe charge object.
     */
    protected function handleChargeRefunded(object $charge): void
    {
        $paymentIntentId = $charge->payment_intent ?? null;

        if (! $paymentIntentId) {
            Log::warning("Refund webhook received without payment_intent ID.");
            return;
        }

        $sale = Sale::where('stripe_payment_intent_id', $paymentIntentId)->first();

        if ($sale && $sale->status !== 'refunded') {
            $sale->update([
                'status' => 'refunded',
            ]);

            Log::info("Sale {$sale->id} marked as REFUNDED via webhook.");
        }
    }

    protected function handleAccountUpdated(object $account): void
    {
        Log::info("Stripe account.updated webhook received for account {$account->id}");

        $user = \App\Models\User::where('stripe_account_id', $account->id)->first();

        if (! $user && isset($account->metadata->user_id)) {
            $user = \App\Models\User::find($account->metadata->user_id);

            if ($user) {
                $user->update(['stripe_account_id' => $account->id]);
                Log::info("User {$user->id} stripe_account_id updated from metadata.");
            }
        }

        if ($user && isset($account->capabilities->transfers) && $account->capabilities->transfers === 'active') {
            $user->update(['stripe_ready' => true]);
            Log::info("User {$user->id} Stripe account now transfer-ready.");
        }
    }

    protected function handleCapabilityUpdated(object $capability): void
    {
        Log::info("Stripe capability.updated webhook for {$capability->id} (#{ $capability->account })");

        $user = \App\Models\User::where('stripe_account_id', $capability->account)->first();

        if (! $user) {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $account = $stripe->accounts->retrieve($capability->account);

            if (isset($account->metadata->user_id)) {
                $user = \App\Models\User::find($account->metadata->user_id);

                if ($user) {
                    $user->update(['stripe_account_id' => $account->id]);
                    Log::info("User {$user->id} stripe_account_id updated from metadata via capability.");
                }
            }
        }

        if ($user && $capability->id === 'transfers' && $capability->status === 'active') {
            $user->update(['stripe_ready' => true]);
            Log::info("User {$user->id} transfers capability activated.");
        }
    }
}
