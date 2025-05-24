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

    public function render()
    {
        return view('livewire.settings.stripe-connect');
    }
}
