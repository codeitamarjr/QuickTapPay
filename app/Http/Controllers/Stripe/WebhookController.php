<?php

namespace App\Http\Controllers\Stripe;

use Stripe\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Stripe\WebhookService;

class WebhookController extends Controller
{
    public function handle(Request $request, WebhookService $webhookService)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage(), [
                'payload' => $payload,
                'signature' => $sigHeader,
            ]);
            return response('Invalid payload', 400);
        }

        $webhookService->handle($event->type, $event->data->object);

        return response('Webhook processed', 200);
    }
}
