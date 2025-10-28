<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureOnboardingIsComplete
{
    /**
     * Redirect users who have not finished onboarding back to the onboarding flow.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user || $user->hasCompletedOnboarding()) {
            return $next($request);
        }

        if ($request->routeIs([
            'onboarding',
            'stripe.connect',
            'stripe.connect.callback',
            'logout',
        ])) {
            return $next($request);
        }

        return redirect()->route('onboarding');
    }
}
