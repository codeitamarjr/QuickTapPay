<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @if (auth()->user()->businesses->count() > 0 && auth()->user()->businesses()->whereHas('paymentLinks')->count() > 0)
                {{-- Show sales widget if businesses exist and have sales --}}
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <livewire:widgets.sales lazy />
                </div>
            @elseif(auth()->user()->businesses->count() > 0 && auth()->user()->businesses()->whereHas('paymentLinks')->count() === 0)
                {{-- Show create payment link widget if businesses exist but no sales --}}
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <x-widgets.create-payment-link lazy />
                </div>
            @elseif(auth()->user()->businesses->count() === 0)
                {{-- Show create business widget if no businesses exist --}}
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <x-widgets.create-business lazy />
                </div>
            @endif
            @if (!auth()->user()->stripe_account_id)
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <x-widgets.connect-widget lazy />
                </div>
            @elseif(auth()->user()->stripe_account_id && !auth()->user()->stripe_ready)
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <x-widgets.stripe-review lazy />
                </div>
            @endif
            {{-- <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div> --}}
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <livewire:sales.sales-table lazy />
        </div>
    </div>
</x-layouts.app>
