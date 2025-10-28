<?php

namespace App\Livewire\Onboarding;

use App\Services\Stripe\ConnectService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    /**
     * Current onboarding step: business, stripe, or complete.
     */
    public string $step = 'business';

    /**
     * Convenience flags for view rendering.
     */
    public bool $hasBusiness = false;
    public bool $stripeConnected = false;

    public function mount(): void
    {
        $user = Auth::user();

        $this->hasBusiness = $user->businesses()->exists();
        $this->stripeConnected = ! empty($user->stripe_account_id);

        $requestedStep = request()->query('step');

        if ($requestedStep === 'stripe' && $this->hasBusiness && ! $this->stripeConnected) {
            $this->step = 'stripe';

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
