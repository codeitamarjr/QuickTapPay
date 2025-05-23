<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\Business;
use App\Models\PaymentLink as PaymentLinkModel;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentLink extends Component
{
    public $business;
    public $paymentLinks;
    public ?PaymentLinkModel $confirmingDelete = null;
    public bool $showDeleteModal = false;

    public function mount(Business $business)
    {
        abort_unless(Auth::user()->businesses->contains($business), 403);
        $this->business = $business;
        $this->loadLinks();
    }

    public function loadLinks()
    {
        $this->paymentLinks = $this->business->paymentLinks()->withCount('sales')->get();
    }

    public function render()
    {
        return view('livewire.payment.payment-link-index');
    }

      public function confirmDelete($id)
    {
        $this->confirmingDelete = PaymentLinkModel::findOrFail($id);
        $this->showDeleteModal = true;
    }

     public function delete()
    {
        if (! $this->confirmingDelete) return;

        abort_unless(
            Auth::user()->businesses()->where('businesses.id', $this->confirmingDelete->business_id)->exists(),
            403
        );

        $this->confirmingDelete->delete();
        session()->flash('success', 'Payment link deleted successfully.');

        $this->confirmingDelete = null;
        $this->showDeleteModal = false;
        $this->loadLinks();
    }
}
