<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Livewire\Component;
use \Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class SalesTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

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
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
    }

    public function updatingSearch()
    {
        sleep(3);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.sales.sales-table', [
            'sales' => $this->sales,
        ]);
    }
}
