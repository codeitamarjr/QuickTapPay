<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\Stripe\ConnectService;

class StripeConnect extends Component
{
    public bool $connected = false;

    public function mount(): void
    {
        $this->connected = !empty(Auth::user()->stripe_account_id);
    }

    public function connect(ConnectService $service)
    {
        return redirect()->away($service->generateConnectUrl(Auth::user()));
    }

    public function disconnect(ConnectService $service)
    {
        $user = Auth::user();

        if (! $user->stripe_account_id) {
            session()->flash('error', 'No connected Stripe account.');
            return;
        }

        $service->disconnect($user);

        $user->update([
            'stripe_account_id' => null,
            'stripe_ready' => false,
        ]);

        $this->connected = false;

        session()->flash('success', 'Disconnected from Stripe successfully.');
    }

    public function delete(ConnectService $service)
    {
        $user = Auth::user();

        if (! $user->stripe_account_id) {
            session()->flash('error', 'No connected Stripe account.');
            return;
        }

        $deleted = $service->deleteConnectedAccount($user);

        if (! $deleted) {
            session()->flash('error', 'Stripe account could not be deleted.');
            return;
        }

        $this->connected = false;

        session()->flash('success', 'Stripe account deleted successfully.');
    }

    public function render()
    {
        return view('livewire.settings.stripe-connect');
    }
}
