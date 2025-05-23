<?php

namespace App\Http\Controllers\Stripe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Stripe\ConnectService;
use Illuminate\Support\Facades\Auth;

class ConnectController extends Controller
{
    public function redirectToStripe(ConnectService $service)
    {
        $user = Auth::user();

        $url = $service->generateConnectUrl($user);

        return redirect()->away($url);
    }

    public function handleCallback(Request $request, ConnectService $service)
    {
        $request->validate(['code' => 'required|string']);

        $stripeUserId = $service->fetchConnectedAccountId($request->get('code'));

        $user = Auth::user();
        $user->stripe_account_id = $stripeUserId;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Stripe account connected successfully.');
    }

    public function disconnect(ConnectService $service)
    {
        $user = Auth::user();

        if (! $user->stripe_account_id) {
            return back()->with('error', 'No connected Stripe account.');
        }

        $service->disconnectAccount($user->stripe_account_id);
        $user->stripe_account_id = null;
        $user->save();

        return back()->with('success', 'Disconnected from Stripe.');
    }
}
