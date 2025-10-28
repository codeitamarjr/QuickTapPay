<?php

namespace App\Livewire\Onboarding;

use App\Models\Business;
use App\Services\Stripe\ConnectService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    /**
     * Current onboarding step: business, stripe, payment-link, or complete.
     */
    public string $step = 'business';

    /**
     * Convenience flags for view rendering.
     */
    public bool $hasBusiness = false;
    public bool $stripeConnected = false;
    public bool $hasPaymentLink = false;
    public ?Business $primaryBusiness = null;

    public function mount(): void
    {
        $user = Auth::user()->load('businesses');
        $businesses = $user->businesses;

        $this->hasBusiness = $businesses->isNotEmpty();
        $this->stripeConnected = ! empty($user->stripe_account_id);
        $this->hasPaymentLink = $user->hasPaymentLinks();
        $this->primaryBusiness = $this->hasBusiness ? $businesses->first() : null;

        $requestedStep = request()->query('step');

        if ($requestedStep === 'stripe' && $this->hasBusiness && ! $this->stripeConnected) {
            $this->step = 'stripe';

            return;
        }

        if ($requestedStep === 'payment-link'
            && $this->hasBusiness
            && $this->stripeConnected
            && ! $this->hasPaymentLink) {
            $this->step = 'payment-link';

            return;
        }

        if ($requestedStep === 'complete' && $user->hasCompletedOnboarding()) {
            $this->step = 'complete';

            return;
        }

        if (! $this->hasBusiness) {
            $this->step = 'business';
        } elseif (! $this->stripeConnected) {
            $this->step = 'stripe';
        } elseif (! $this->hasPaymentLink) {
            $this->step = 'payment-link';
        } else {
            $this->step = 'complete';
        }
    }

    public function connectStripe(ConnectService $service)
    {
        return redirect()->away($service->generateConnectUrl(Auth::user()));
    }

    public function render()
    {
        return view('livewire.onboarding.index');
    }
}
