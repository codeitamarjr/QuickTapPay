<?php

namespace App\Services\Stripe;

use Stripe\Stripe;
use Stripe\Account;
use App\Models\User;
use Stripe\AccountLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ConnectService
{
    public function generateConnectUrl(User $user): string
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $account = Account::create([
            'type' => 'express',
            'email' => $user->email,
            'metadata' => [
                'user_id' => $user->id,
            ],
            'capabilities' => [
                'transfers' => ['requested' => true],
            ],
        ]);

        $user->update([
            'stripe_account_id' => $account->id,
            'stripe_ready' => false,
        ]);

        $accountLink = AccountLink::create([
            'account' => $account->id,
            'refresh_url' => route('dashboard'),
            'return_url' => route('stripe.connect.callback'),
            'type' => 'account_onboarding',
        ]);

        return $accountLink->url;

        // $params = [
        //     'response_type' => 'code',
        //     'client_id' => config('services.stripe.client_id'),
        //     'scope' => 'read_write',
        //     'redirect_uri' => route('stripe.connect.callback'),
        //     'stripe_user[email]' => $userData['email'] ?? null,
        //     'stripe_user[business_name]' => $userData['business_name'] ?? null,
        //     'stripe_user[url]' => $userData['url'] ?? null,
        //     'stripe_user[country]' => $userData['country'] ?? 'IE',
        //     'state' => $state ?? csrf_token(),
        // ];

        // return 'https://connect.stripe.com/oauth/authorize?' . http_build_query(array_filter($params));
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
}
