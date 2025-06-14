<?php

/**
 * File: ConnectService.php
 * © 2025 Itamar Atanasio Da Silva Junior. All rights reserved.
 * This file is part of the Quick Tap Pay proprietary software.
 * Unauthorized copying or distribution of this file, via any medium, is strictly prohibited.
 */

namespace App\Services\Stripe;

use Stripe\Stripe;
use Stripe\Account;
use App\Models\User;
use Stripe\AccountLink;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class ConnectService
{
    /**
     * Generates a URL for connecting a Stripe account via OAuth.
     *
     * @param \App\Models\User $user
     * @return string
     */
    public function generateConnectUrl(User $user): string
    {

        $url = \Stripe\OAuth::authorizeUrl([
            'response_type' => 'code',
            'client_id' => config('services.stripe.client_id'),
            'scope' => 'read_write',
            'redirect_uri' => route('stripe.connect.callback'),
            'state' => encrypt($user->id),
        ]);

        return $url;
    }

    public function fetchConnectedAccountId(string $authorizationCode): string
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $response = \Stripe\OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $authorizationCode,
        ]);

        return $response->stripe_user_id;
    }

    public function disconnectAccount(string $stripeUserId): bool
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        \Stripe\OAuth::deauthorize([
            'client_id' => config('services.stripe.client_id'),
            'stripe_user_id' => $stripeUserId,
        ]);

        return true;
    }

    /**
     * Disconnect a user from their Stripe account.
     *
     * This method updates the user's model by setting `stripe_account_id` to null and `stripe_ready` to false.
     *
     * @param User $user The user to disconnect from Stripe.
     *
     * @return void
     */
    public function disconnect(User $user): void
    {
        $user->update([
            'stripe_account_id' => null,
            'stripe_ready' => false,
        ]);

        Log::info("User {$user->id} disconnected from Stripe.");
    }

    /**
     * Delete a user's connected Stripe account.
     *
     * This method attempts to delete the Stripe account associated with the given user.
     * If the account is already inaccessible (e.g., due to being deleted from the Stripe dashboard),
     * it logs a warning and treats the operation as a successful cleanup. In case of any errors,
     * it logs the error details and returns false.
     *
     * @param User $user The user whose Stripe account is to be deleted.
     * 
     * @return bool True if the account was deleted successfully or already inaccessible, false otherwise.
     */
    public function deleteConnectedAccount(User $user): bool
    {
        $stripe = new StripeClient(config('services.stripe.secret'));

        try {
            Log::info("Attempting to delete Stripe account for user {$user->id}: {$user->stripe_account_id}");

            $stripe->accounts->delete($user->stripe_account_id);
            $this->disconnect($user);

            Log::info("Stripe account deleted successfully for user {$user->id}.");

            return true;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            if (str_contains($e->getMessage(), 'does not have access')) {
                Log::warning("Stripe account {$user->stripe_account_id} already inaccessible.");
                return true;
            }

            Log::error("Stripe error deleting account: " . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            Log::error("General error deleting Stripe account: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the Stripe balance for a connected account.
     *
     * This method uses the Stripe API to retrieve the balance of the specified connected account.
     *
     * @param string $connectedAccountId The ID of the connected Stripe account.
     *
     * @return array The Stripe balance data.
     */
    public function getBalance(string $connectedAccountId): array
    {
        $stripe = new StripeClient(config('services.stripe.secret'));

        return $stripe->balance->retrieve([], [
            'stripe_account' => $connectedAccountId,
        ])->toArray();
    }
}
