<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Livewire\Component;
use App\Models\PaymentLink;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.checkout.simple')]
class SalesCancel extends Component
{
    public PaymentLink $link;

    public function mount(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required|string',
        ]);

        $session_id = $validated['session_id'];
        $sale = Sale::where('stripe_session_id', $session_id)->firstOrFail();

        if ($sale->status !== 'cancelled') {
            $sale->update(['status' => 'cancelled']);
        }

        $this->link = $sale->paymentLink;
    }

    public function render(Request $request)
    {
        return view('livewire.sales.sales-cancel');
    }
}
