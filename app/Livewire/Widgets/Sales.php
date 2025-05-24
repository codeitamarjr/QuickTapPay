<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Sales extends Component
{
    public $topCurrency;
    public $topCurrencyTotal = 0;

    public function mount()
    {
        $user = Auth::user();

        $topCurrency = \App\Models\Sale::select('currency', DB::raw('SUM(amount) as total'))
            ->whereHas('paymentLink.business.users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->groupBy('currency')
            ->orderByDesc('total')
            ->first();

        $this->topCurrency = $topCurrency->currency;
        $this->topCurrencyTotal = $topCurrency->total;
    }
    public function render()
    {
        return view('livewire.widgets.sales');
    }
}
