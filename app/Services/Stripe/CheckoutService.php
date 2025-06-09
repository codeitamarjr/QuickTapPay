<?php

/**
 * File: CheckoutService.php
 * © 2025 Itamar Atanasio Da Silva Junior. All rights reserved.
 * This file is part of the Quick Tap Pay proprietary software.
 * Unauthorized copying or distribution of this file, via any medium, is strictly prohibited.
 */

namespace App\Services\Stripe;

use Stripe\Stripe;
use App\Models\Sale;
use Stripe\StripeClient;
use App\Models\PaymentLink;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session as StripeSession;

class CheckoutService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe checkout session for a given payment link and customer data.
     */
    public function createCheckoutSession(PaymentLink $link, array $customerData): string
    {
        $business = $link->business->load('users');
        $businessId = $business->id;
        $user = $business->users->where('pivot.role', 'admin')->first();
        $connectedAccountId = $user->stripe_account_id;

        if (! $user->stripe_ready) {
            abort(400, 'Your Stripe account is still being verified. Please try again later.');
        }

        abort_unless($connectedAccountId, 400, 'You need to connect your Stripe account first.');

        $platformAccountId = config('services.stripe.account_id');

        $applicationFeeAmount = max(1, (int) round($link->amount * 0.01 * 100));
        $lineAmount = (int) round($link->amount * 100);

        Stripe::setApiKey(config('services.stripe.secret'));

        // Common session payload
        $sessionPayload = [
            'payment_method_types' => ['card'],
            'customer_email' => $customerData['email'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $link->title,
                        'description' => $link->description,
                    ],
                    'unit_amount' => $lineAmount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
            'payment_intent_data' => [
                'metadata' => [
                    'payment_link_id' => $link->id,
                    'customer_email' => $customerData['email'],
                    'customer_phone' => $customerData['phone'],
                    'customer_reference' => $customerData['reference'],
                    'application_fee_eur' => $applicationFeeAmount / 100,
                ],
            ],
        ];

        // Only set transfer data if this is NOT the platform account
        if ($connectedAccountId !== $platformAccountId) {
            $sessionPayload['payment_intent_data']['application_fee_amount'] = $applicationFeeAmount;
            $sessionPayload['payment_intent_data']['transfer_data'] = [
                'destination' => $connectedAccountId,
            ];
        }

        // Create the session
        $session = StripeSession::create($sessionPayload);

        // Save the sale
        $sale = Sale::create([
            'business_id' => $businessId,
            'payment_link_id' => $link->id,
            'amount' => $link->amount,
            'currency' => $link->currency,

            'name' => $customerData['name'],
            'email' => $customerData['email'],
            'phone' => $customerData['phone'],
            'reference' => $customerData['reference'],

            'status' => 'pending',
            'payment_method' => 'card',
            'transaction_id' => Str::uuid(),

            'stripe_session_id' => $session->id,
            'stripe_payment_intent_id' =>  $session->payment_intent,
        ]);

        Mail::to($sale->email)->queue(new \App\Mail\SaleNotification($sale, 'created'));

        return $session->url;
    }
}
