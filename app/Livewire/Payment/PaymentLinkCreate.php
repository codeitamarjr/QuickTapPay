<?php

namespace App\Livewire\Payment;

use App\Models\Business;
use Livewire\Component;
use App\Models\PaymentLink;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PaymentLinkCreate extends Component
{
    public $business;
    public string $title = '';
    public float $amount = 0.0;
    public ?string $slug = null;
    public string $description = '';
    public string $payment_method = 'credit_card';
    public string $currency = 'EUR';
    public string $status = 'active';
    
    public bool $is_active = true;

    public function mount(Business $business)
    {
        abort_unless(Auth::user()->businesses->contains($business), 403);
        $this->business = $business;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.5',
            'description' => 'nullable|string|max:1000',
        ]);

        PaymentLink::create([
            'business_id' => $this->business->id,
            'title' => $this->title,
            'amount' => $this->amount,
            'slug' => Str::slug($this->title) . '-' . uniqid(),
            'description' => $this->description,
            'user_id' => Auth::id(),
            'status' => 'active',
            'payment_method' => 'credit_card',
            'currency' => $this->currency,
        ]);

        session()->flash('success', 'Payment link created successfully!');
        return redirect()->route('payment-links.index', ['business' => $this->business]);
    }

    public function render()
    {
        return view('livewire.payment.payment-link-create');
    }
}
