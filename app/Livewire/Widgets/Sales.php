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
            ->where('status', 'paid')
            ->groupBy('currency')
            ->orderByDesc('total')
            ->first();

        $this->topCurrency = $topCurrency->currency ?? 'EUR';
        $this->topCurrencyTotal = $topCurrency->total ?? 0;
    }
    public function render()
    {
        return view('livewire.widgets.sales');
    }
}
