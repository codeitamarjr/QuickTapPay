<?php

namespace App\Services\Stripe\Handlers;

use Illuminate\Support\Facades\Log;

class CapabilityUpdated
{

    /**
     * Handle the `capability.updated` event from Stripe.
     *
     * This function logs the received capability update event and attempts to find
     * a user associated with the Stripe account ID from the capability object. If
     * no user is found, it retrieves the account from Stripe and checks the metadata
     * for a user ID, updating the user's Stripe account ID if found. If the capability
     * is for 'transfers' and is active, it sets the user's `stripe_ready` flag to true.
     *
     * @param object $capability The Stripe capability object.
     */
    public function handle(object $capability): void
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
