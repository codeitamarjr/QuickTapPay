<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Stripe\WebhookController;

Route::middleware('auth')->prefix('stripe')->name('stripe.')->group(function () {
    Route::get('connect', [\App\Http\Controllers\Stripe\ConnectController::class, 'redirectToStripe'])->name('connect');
    Route::get('connect/callback', [\App\Http\Controllers\Stripe\ConnectController::class, 'handleCallback'])->name('connect.callback');
    Route::post('disconnect', [\App\Http\Controllers\Stripe\ConnectController::class, 'disconnect'])->name('disconnect');
});

Route::post('stripe/webhook', [WebhookController::class, 'handle'])->name('stripe.webhook');