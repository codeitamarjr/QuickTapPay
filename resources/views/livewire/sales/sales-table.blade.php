<div class="bg-white dark:bg-gray-800 relative overflow-hidden">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" wire:model.live.debounce.1000ms="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Search" required="">
                </div>
            </form>
        </div>
        <div
            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <button type="button"
                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add product
            </button>
            <div class="flex items-center space-x-3 w-full md:w-auto">
                <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                    Actions
                </button>
                <div id="actionsDropdown"
                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass
                                Edit</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="#"
                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                            all</a>
                    </div>
                </div>
                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400"
                        viewbox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd" />
                    </svg>
                    Filter
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
                <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose brand</h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                        <li class="flex items-center">
                            <input id="apple" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="apple"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple (56)</label>
                        </li>
                        <li class="flex items-center">
                            <input id="fitbit" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="fitbit"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Microsoft (16)</label>
                        </li>
                        <li class="flex items-center">
                            <input id="razor" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="razor"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Razor (49)</label>
                        </li>
                        <li class="flex items-center">
                            <input id="nikon" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="nikon"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nikon (12)</label>
                        </li>
                        <li class="flex items-center">
                            <input id="benq" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="benq"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">BenQ (74)</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">

        <table class="w-full h-full mb-20 text-sm text-left text-gray-500 dark:text-gray-400"
            wire:loading.class="opacity-50">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Product</th>
                    <th scope="col" class="px-4 py-3">Customer</th>
                    <th scope="col" class="px-4 py-3" wire:click="sort('created_at')">
                        <div class="flex items-center">
                            @if ($sortBy === 'created_at')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-6 duration-400 transform  ease-in-out
                                @if ($sortDirection === 'asc' && $sortBy === 'created_at') rotate-180 @endif">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            @endif
                            Date
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" wire:click="sort('status')">
                        <div class="flex items-center">
                            @if ($sortBy === 'status')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-6 duration-400 transform  ease-in-out
                                @if ($sortDirection === 'asc' && $sortBy === 'status') rotate-180 @endif">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            @endif
                            Status
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" wire:click="sort('amount')">
                        <div class="flex items-center">
                            @if ($sortBy === 'amount')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-6 duration-400 transform  ease-in-out
                                @if ($sortDirection === 'asc' && $sortBy === 'amount') rotate-180 @endif">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            @endif
                            Amount
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr class="border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-4 py-3 font-medium text-gray-900 dark:text-gray-200 whitespace-nowrap dark:text-white">
                            <div class="text-sm/6 text-gray-500 dark:text-gray-400">
                                {{ $sale->paymentLink->business->name }}</div>
                            <div class="text-sm/6 text-gray-900 dark:text-gray-200">{{ $sale->paymentLink->title }}
                            </div>
                            <div class="mt-1 text-xs/5 text-gray-500 dark:text-gray-400">{{ $sale->transaction_id }}
                            </div>
                        </th>
                        <td class="px-4 py-3">
                            <div class="text-sm/6 text-gray-900 dark:text-gray-200">{{ $sale->name }}</div>
                            <div class="text-sm/6 text-gray-900 dark:text-gray-200">{{ $sale->phone }}</div>
                            <div class="mt-1 text-xs/5 text-gray-500 dark:text-gray-400">{{ $sale->email }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm/6 text-gray-900 dark:text-gray-200">
                                {{ $sale->created_at->format('d/m/Y') }}</div>
                            <div class="mt-1 text-xs/5 text-gray-500 dark:text-gray-400">
                                {{ $sale->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $color = match ($sale->status) {
                                    'pending' => 'yellow',
                                    'paid' => 'green',
                                    'cancelled' => 'red',
                                    'refunded' => 'orange',
                                    default => 'gray',
                                };
                            @endphp
                            <flux:badge color="{{ $color }}" size="sm" inset="top bottom">
                                {{ Str::upper($sale->status) }}
                            </flux:badge>
                        </td>
                        <td class="px-4 py-3">
                            {{ Number::currency($sale->amount, $sale->paymentLink->business->currency) }}
                        </td>
                        <td class="px-4 py-3">
                            @if (Auth::user()->isAdmin($sale->paymentLink->business))
                                <div x-data="{ open: false }">
                                    <button id="apple-imac-27-dropdown-button"
                                        data-dropdown-toggle="apple-imac-27-dropdown" @click="open = !open"
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown"
                                        class="absolute right-0 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                                        x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                @if ($sale->status === 'paid')
                                                    <div wire:click="refund({{ $sale->id }})"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                        Refund
                                                    </div>
                                                @endif
                                            </li>
                                            {{-- <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li> --}}
                                        </ul>
                                        {{-- <div class="py-1">
                                        <a href="#"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                    </div> --}}
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach

                @if ($sales->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-40 text-gray-500">
                            No sales found.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        @if ($selectedSale)
            <x-ui.modal wire:model="showRefundModal" maxWidth="7xl">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Confirm Refund</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        Are you sure you want to refund
                        <strong>{{ Number::currency($selectedSale->amount, $selectedSale->paymentLink->business->currency) }}</strong>
                        to <strong>{{ $selectedSale->name }}</strong>?
                    </p>

                    <div class="mt-4 flex justify-end space-x-2">
                        <button wire:click="$set('showRefundModal', false)"
                            class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500">
                            Cancel
                        </button>
                        <button wire:click="confirmRefund"
                            class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                            Confirm Refund
                        </button>
                    </div>
                </div>
            </x-ui.modal>
        @endif

    </div>
    <div class="px-4 py-3 sm:px-6">
        {{ $sales->links() }}
    </div>
</div>
