<?php

namespace App\Http\Controllers\Stripe;

use Stripe\Stripe;
use App\Models\Sale;
use Livewire\Livewire;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Livewire\Sales\SalesCancel;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Livewire\Sales\SalesSuccess;

class CheckoutController extends Controller
{
    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (! $sessionId) {
            return redirect()->route('home')->with('error', 'Missing session ID.');
        }

        return App::call(SalesSuccess::class);
    }

    public function cancel()
    {
        return App::call(SalesCancel::class);
    }
}
