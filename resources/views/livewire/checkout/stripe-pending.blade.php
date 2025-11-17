<div>
    <x-slot name="logo">
        @if ($link->business->logo_url)
            <img src="{{ $link->business->logo_url }}" alt="{{ $link->business->name }}"
                class="h-8 w-auto" />
        @endif
    </x-slot>

    <x-slot name="title">{{ $link->business->name ?? 'Checkout' }}</x-slot>

    <x-slot name="description">
        {{ __('Payments are temporarily unavailable while we complete verification.') }}
    </x-slot>

    <div class="bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 px-6 py-6 sm:px-8">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/15 text-white">
                            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-white space-y-1">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70">Checkout paused</p>
                            <h2 class="text-xl font-semibold leading-tight">This payment link isn’t ready just yet</h2>
                            <p class="text-sm text-white/80">
                                The seller is completing Stripe’s verification. Payments will open as soon as their
                                account is cleared.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 p-6 sm:p-8">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 7l9 4l9-4m-9 13V11M4 9v6a2 2 0 001.105 1.789l6.447 3.223a1 1 0 00.896 0l6.447-3.223A2 2 0 0020 15V9" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $link->business->name }}</p>
                            <p class="text-sm text-gray-600">
                                {{ $link->title }} &middot; {{ Number::currency($link->amount, $link->business->currency) }}
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <p class="text-sm font-semibold text-gray-900">Why am I seeing this?</p>
                            <p class="mt-2 text-sm text-gray-600">
                                Stripe requires a quick review before this business can start accepting payments. This
                                helps keep every transaction secure.
                            </p>
                        </div>
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <p class="text-sm font-semibold text-gray-900">What can I do?</p>
                            <p class="mt-2 text-sm text-gray-600">
                                Please try again in a bit. If you need to pay right now, reach out to the seller for an
                                update.
                            </p>
                            @if ($link->business->email)
                                <a href="mailto:{{ $link->business->email }}"
                                    class="mt-3 inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                                    Contact {{ $link->business->name }}
                                    <span aria-hidden="true" class="ml-1">→</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-xl border border-dashed border-indigo-200 bg-indigo-50/60 p-4">
                        <div class="flex items-start gap-3 text-indigo-900">
                            <svg class="h-5 w-5 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold">Secure checkout with QuickTapPay + Stripe</p>
                                <p class="mt-1 text-sm text-indigo-900/80">
                                    We only enable payments when the seller’s account meets Stripe’s safety checks. Thanks
                                    for your patience.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ url()->previous() ?: route('home') }}"
                            class="inline-flex items-center justify-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:border-gray-300 hover:text-gray-800">
                            Go back
                        </a>
                        <span class="text-xs text-gray-500">Powered by QuickTapPay · Stripe</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
