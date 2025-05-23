<section class="w-full">
    @include('partials.payment-links-heading')

    <x-payment.layout :heading="__('Payment Links')" :subheading="__('Create and manage payment links.')" :business="$business">
        {{-- Flash messages --}}
        @if (session('success'))
            <div class="mb-4">
                <x-ui.flash-message type="success" title="Success">
                    {{ session('success') }}
                </x-ui.flash-message>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4">
                <x-ui.flash-message type="error" title="Error">
                    {{ session('error') }}
                </x-ui.flash-message>
            </div>
        @endif

        {{-- Create Payment Link Button --}}
        <div class="my-6 w-full space-y-4">
            @forelse ($paymentLinks as $link)
                <div class="flex justify-between border-b border-neutral-200 dark:border-neutral-700 pb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $link->title }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ Number::currency($link->amount, $link->business->currency) }} &middot;
                            {{ $link->sales_count }} sales
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('checkout.show', ['paymentLink' => $link->slug]) }}" target="_blank">
                            <flux:button size="sm" variant="outline">{{ __('View') }}</flux:button>
                        </a>
                        <a href="{{ route('payment-links.edit', ['business' => $business->id, 'paymentLink' => $link->id]) }}">
                            <flux:button size="sm" variant="outline">{{ __('Edit') }}</flux:button>
                        </a>
                        <flux:button size="sm" variant="outline" class="!text-red-600 hover:!bg-red-100"
                            wire:click="confirmDelete({{ $link->id }})">
                            {{ __('Delete') }}
                        </flux:button>
                    </div>
                </div>
            @empty
                <flux:text>{{ __('No payment links created yet.') }}</flux:text>
            @endforelse
            @if ($confirmingDelete)
                <x-ui.modal wire:model="showDeleteModal">
                    <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-red-100">
                        <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">
                            {{ __('Delete Payment Link') }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                {{ __('Are you sure you want to delete ":name"? This action cannot be undone.', ['name' => $confirmingDelete->title]) }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <flux:button type="button" variant="outline" class="w-full"
                            wire:click="$set('showDeleteModal', false); $set('confirmingDelete', null);">
                            {{ __('Cancel') }}
                        </flux:button>
                        <flux:button type="button" variant="outline" class="!text-red-600 hover:!bg-red-100"
                            wire:click="delete">
                            {{ __('Yes, delete') }}
                        </flux:button>
                    </div>
                </x-ui.modal>
            @endif
        </div>
    </x-payment.layout>
</section>
