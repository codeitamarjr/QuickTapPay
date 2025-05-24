<?php

/**
 * File: AccountUpdated.php
 * © 2025 Itamar Atanasio Da Silva Junior. All rights reserved.
 * This file is part of the Quick Tap Pay proprietary software.
 * Unauthorized copying or distribution of this file, via any medium, is strictly prohibited.
 */

namespace App\Services\Stripe\Handlers;

use Illuminate\Support\Facades\Log;

class AccountUpdated
{

    /**
     * Handle the `account.updated` event from Stripe.
     *
     * This function first checks if there is a user with the given Stripe account ID. If not, it checks if the
     * Stripe account has a user ID in its metadata and updates the user record with the Stripe account ID if found.
     *
     * If a user is found and the Stripe account has transfers capability, it also sets the user's `stripe_ready` flag
     * to true.
     *
     * @param object $account The Stripe account object.
     */
    public function handle(object $account): void
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
}
