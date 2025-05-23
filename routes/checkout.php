<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Stripe\CheckoutController;

Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

Route::get('checkout/{paymentLink:slug}', \App\Livewire\Checkout\Checkout::class)->name('checkout.show');

// Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
// Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
// Route::post('/stripe/webhook', [WebhookController::class, 'handle'])->name('stripe.webhook');
