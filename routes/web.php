<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/launch', function () {
    return view('launch');
})->name('launch');

Route::get('/learn-more', function () {
    return view('learn-more');
})->name('learn.more');

Route::view('/how-to', 'how-to')->name('how.to');

Route::get('/terms-of-service', function () {
    return view('terms');
})->name('terms.of.service');

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy.policy');

Route::get('/vendor-disclaimer', function () {
    return view('disclaimer');
})->name('vendor.disclaimer');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'onboarded'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('onboarding', \App\Livewire\Onboarding\Index::class)->name('onboarding');
});

Route::middleware(['auth', 'onboarded'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('business', \App\Livewire\Business::class)->name('business.index');
    Route::get('business/create', \App\Livewire\BusinessCreate::class)->name('business.create');
    Route::get('business/{business}/edit', \App\Livewire\BusinessEdit::class)->name('business.edit');
    Route::get('businesses/{business}/team', \App\Livewire\Members\BusinessTeam::class)->name('business.team');
    Route::get('businesses/{business}/team/create', \App\Livewire\Members\BusinessTeamCreate::class)->name('business.team.create');

    Route::get('payment-links/{business}', \App\Livewire\Payment\PaymentLink::class)->name('payment-links.index');
    Route::get('payment-links/{business}/create', \App\Livewire\Payment\PaymentLinkCreate::class)->name('payment-links.create');
    Route::get('payment-links/{business}/{paymentLink}/edit', \App\Livewire\Payment\PaymentLinkEdit::class)->name('payment-links.edit');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/checkout.php';
require __DIR__ . '/stripe.php';
