<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\PaymentLink;
use Livewire\Attributes\Layout;
use App\Services\Stripe\CheckoutService;
use Illuminate\Support\Facades\Redirect;

#[Layout('components.layouts.checkout.simple')]
class Checkout extends Component
{
    public PaymentLink $link;

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $reference = '';

    public function mount(PaymentLink $paymentLink)
    {
        $this->link = $paymentLink->load('business');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'reference' => 'nullable|string|max:255',
        ]);

        $checkoutUrl = (new CheckoutService())->createCheckoutSession($this->link, [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'reference' => $this->reference,
            'currency' => $this->link->business->currency,
        ]);

        return Redirect::away($checkoutUrl);
    }

    public function render()
    {
        return view('livewire.checkout.checkout');
    }
}
