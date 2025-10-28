<?php

namespace App\Http\Controllers\Stripe;

use App\Models\User;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Stripe\ConnectService;

class ConnectController extends Controller
{
    public function redirectToStripe(ConnectService $service)
    {
        $user = Auth::user();

        $url = $service->generateConnectUrl($user);

        return redirect()->away($url);
    }

    /**
     * Handle the callback from Stripe OAuth.
     *
     * This method validates the incoming request to ensure the presence of the
     * 'code' parameter, then attempts to fetch the connected Stripe account ID
     * using the ConnectService. Upon success, it updates the authenticated user's
     * model with the retrieved Stripe account ID and redirects to the dashboard
     * with a success message. If an error occurs, it logs the error and redirects
     * to the dashboard with an error message.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     * @param \App\Services\Stripe\ConnectService $service The service to interact
     * with Stripe's Connect API.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the dashboard
     * with a success or error message.
     */
    public function handleCallback(Request $request, ConnectService $service)
    {
        $validated = $request->validate([
            'code' => 'required|string',
        ]);

        try {
            $stripeUserId = $service->fetchConnectedAccountId($validated['code']);
            $user = Auth::user();

            $user->update([
                'stripe_account_id' => $stripeUserId,
            ]);

            $user->refresh();

            if ($user->hasCompletedOnboarding()) {
                return redirect()
                    ->route('onboarding', ['step' => 'complete'])
                    ->with('success', 'Stripe account connected successfully.');
            }

            return redirect()
                ->route('onboarding', ['step' => 'stripe'])
                ->with('success', 'Stripe account connected successfully.');
        } catch (\Exception $e) {
            report($e);
            return redirect()
                ->route('onboarding', ['step' => 'stripe'])
                ->with('error', 'Failed to connect Stripe account. Please try again.');
        }
    }

    /**
     * Disconnect a user from their Stripe account.
     *
     * This method validates the user's current password and then calls
     * the disconnect method on the ConnectService, which will update the
     * user's model by setting stripe_account_id to null and stripe_ready to false.
     *
     * @param  \App\Services\Stripe\ConnectService  $service
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disconnect(ConnectService $service, Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        $user = Auth::user();

        if (! $user->stripe_account_id) {
            return back()->with('error', 'No connected Stripe account.');
        }

        $service->disconnect($user);

        return back()->with('success', 'Disconnected from Stripe.');
    }



    /**
     * Delete a user's connected Stripe account.
     *
     * This method validates the user's current password and then calls
     * the deleteConnectedAccount method on the ConnectService, which will
     * attempt to delete the Stripe account associated with the given user.
     * If the account is already inaccessible (e.g., due to being deleted from
     * the Stripe dashboard), it logs a warning and treats the operation as a
     * successful cleanup. In case of any errors, it logs the error details
     * and returns false.
     *
     * @param  \App\Services\Stripe\ConnectService  $service
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(ConnectService $service, Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        $user = Auth::user();

        if (! $user->stripe_account_id) {
            return back()->with('error', 'No connected Stripe account.');
        }

        $deleted = $service->deleteConnectedAccount($user);

        if (! $deleted) {
            return back()->with('error', 'Stripe account could not be deleted.');
        }

        $user->update([
            'stripe_account_id' => null,
            'stripe_ready' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Your Stripe account was deleted or disconnected successfully.');
    }
}
