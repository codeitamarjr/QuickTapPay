<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\Stripe\ConnectService;

class StripeWidget extends Component
{
    public $stripeBalance;

    public function mount(ConnectService $connectService)
    {
        $user = Auth::user();

        if (!$user->stripe_account_id) {
            abort(403, 'No connected Stripe account.');
        }

        $this->stripeBalance = $connectService->getBalance($user->stripe_account_id);
    }

    public function render()
    {
        return view('livewire.widgets.stripe-widget');
    }
}
