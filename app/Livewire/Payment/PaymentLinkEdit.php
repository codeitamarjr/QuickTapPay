<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\Business;
use App\Models\PaymentLink;
use Illuminate\Support\Facades\Auth;

class PaymentLinkEdit extends Component
{
    public Business $business;
    public PaymentLink $paymentLink;

    public string $title;
    public string $currency = 'EUR';
    public float $amount;
    public string $description = '';
    public bool $is_active = true;

    public function mount(Business $business, PaymentLink $paymentLink)
    {
        abort_unless(Auth::user()->businesses->contains($business), 403);
        abort_unless($paymentLink->business_id === $business->id, 403);

        $this->business = $business;
        $this->paymentLink = $paymentLink;

        $this->title = $paymentLink->title;
        $this->currency = $paymentLink->currency;
        $this->amount = $paymentLink->amount;
        $this->description = $paymentLink->description;
        $this->is_active = $paymentLink->status === 'active';
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'currency' => 'required|string|max:3',
            'amount' => 'required|numeric|min:0.5',
            'description' => 'nullable|string|max:1000',
        ]);

        $this->paymentLink->update([
            'title' => $this->title,
            'currency' => $this->currency,
            'amount' => $this->amount,
            'description' => $this->description,
            'status' => $this->is_active ? 'active' : 'inactive',
        ]);

        session()->flash('success', 'Payment link updated successfully.');
        return redirect()->route('payment-links.index', $this->business);
    }

    public function render()
    {
        return view('livewire.payment.payment-link-edit');
    }
}
