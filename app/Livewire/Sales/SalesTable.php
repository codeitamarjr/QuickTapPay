<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Livewire\Component;
use \Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Services\Stripe\RefundService;

class SalesTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public bool $showRefundModal = false;
    public ?Sale $selectedSale = null;
    public $filterOptions = [
        'all' => 'All',
        'paid' => 'Paid',
        'unpaid' => 'Unpaid',
        'refunded' => 'Refunded',
    ];
    public $filter = 'all';

    /**
     * Initialize the component.
     *
     * Retrieve the filter option from the session or default to 'all'
     * if it does not exist.
     *
     * @return void
     */
    public function mount()
    {
        $this->filter = session('sales_filter', 'all');
    }

    /**
     * Set the sales filter and reset the pagination.
     *
     * Called when the filter select is changed.
     *
     * @param string $value The new filter value.
     *
     * @return void
     */
    public function updatedFilter($value)
    {
        session(['sales_filter' => $value]);
        $this->resetPage();
    }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Return a paginated list of sales associated with the current user.
     *
     * This list is filtered by the current search term and sorted by the
     * current sort column and direction.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    #[\Livewire\Attributes\Computed]
    public function sales()
    {
        $user = Auth::user();
        $businessIds = $user->businesses()->pluck('businesses.id');

        return Sale::query()
            ->whereHas('paymentLink', function ($query) use ($businessIds) {
                $query->whereIn('business_id', $businessIds);
            })
            ->with(['paymentLink', 'paymentLink.business']) // optional eager load
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%')
                        ->orWhere('reference', 'like', '%' . $this->search . '%')
                        ->orWhere('transaction_id', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filter !== 'all', function ($query) {
                $query->where('status', $this->filter);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
    }

    public function updatingSearch()
    {
        sleep(3);
        $this->resetPage();
    }

    public function refund(Sale $sale, RefundService $refundService)
    {
        abort_unless($sale->paymentLink->business->users->where('pivot.role', 'admin')->first()?->stripe_account_id, 403, 'You need to connect your Stripe account first.');
        abort_if($sale->status !== 'paid', 403, 'This sale has not been paid.');
        abort_if($sale->status === 'refunded', 403, 'This sale has already been refunded.');

        $this->showRefundModal = true;
        $this->selectedSale = $sale;
    }

    public function confirmRefund(RefundService $refundService)
    {
        try {
            $refundService->process($this->selectedSale);
            session()->flash('success', 'Refund issued successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Refund failed: ' . $e->getMessage());
        }

        $this->showRefundModal = false;
        $this->selectedSale = null;
    }

    public function render()
    {
        return view('livewire.sales.sales-table', [
            'sales' => $this->sales,
        ]);
    }
}
