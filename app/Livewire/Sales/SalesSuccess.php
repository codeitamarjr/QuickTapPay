<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Livewire\Component;
use App\Models\PaymentLink;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.checkout.simple')]
class SalesSuccess extends Component
{
    public ?Sale $sale = null;
    public PaymentLink $link;

    public function mount(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required|string',
        ]);

        $session_id = $validated['session_id'];
        $this->sale = Sale::where('stripe_session_id', $session_id)->firstOrFail();

        if ($this->sale->status !== 'paid') {
            $this->sale->update(['status' => 'paid']);
        }

        $this->link = $this->sale->paymentLink;
    }

    public function render()
    {
        return view('livewire.sales.sales-success');
    }
}
