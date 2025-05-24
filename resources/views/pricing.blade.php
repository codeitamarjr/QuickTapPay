@extends('components.layouts.landing.layout')
@section('title', 'Privacy Policy')
@section('content')

    <div class="relative">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 lg:w-full lg:max-w-2xl">
                <svg class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 transform fill-white lg:block"
                    viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="0,0 90,0 50,100 0,100" />
                </svg>

                <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:py-50 lg:pr-0">
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                        <h2
                            class="text-pretty text-5xl font-semibold tracking-tight text-gray-900 sm:text-balance sm:text-6xl">
                            Clear, fair pricing.
                        </h2>
                        <p class="mx-auto mt-6 max-w-2xl text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                            QuickTapPay charges a flat 1% fee on each transaction. Stripe also applies its standard
                            processing fees depending on the payment method used.
                        </p>
                    </div>
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl rounded-3xl ring-1 ring-gray-200 sm:mt-20 mt-10">
                        <div class="p-8 sm:p-10 lg:flex-auto">
                            <h3 class="text-3xl font-semibold tracking-tight text-gray-900">
                                Platform Fee
                            </h3>
                            <p class="mt-6 text-base/7 text-gray-600">
                                For every successful payment through QuickTapPay, we charge a simple 1% platform fee. No
                                hidden costs, no complicated tiers.
                            </p>
                            <div class="mt-10 flex items-center gap-x-4">
                                <h4 class="flex-none text-sm/6 font-semibold text-indigo-600">What you get</h4>
                                <div class="h-px flex-auto bg-gray-100"></div>
                            </div>
                            <ul role="list"
                                class="mt-8 grid grid-cols-1 gap-4 text-sm/6 text-gray-600 sm:grid-cols-2 sm:gap-6">
                                <li class="flex gap-x-3">
                                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Unlimited payment links
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Instant Stripe payouts
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Real-time sales dashboard
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Secure checkout hosted by Stripe
                                </li>
                            </ul>

                            <p class="mt-8 text-sm text-gray-500">
                                * Platform fees are automatically deducted at the time of payment.
                            </p>
                        </div>

                        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl p-2">
                            <div
                                class="rounded-2xl bg-gray-50 py-10 text-center ring-1 ring-inset ring-gray-900/5 lg:flex lg:flex-col lg:justify-center lg:py-16">
                                <div class="mx-auto max-w-xs px-8">
                                    <p class="text-base font-semibold text-gray-600">
                                        Platform fee
                                    </p>
                                    <p class="mt-6 flex items-baseline justify-center gap-x-2">
                                        <span class="text-5xl font-semibold tracking-tight text-gray-900">1%</span>
                                        <span class="text-sm/6 font-semibold tracking-wide text-gray-600">of
                                            transaction</span>
                                    </p>
                                    @auth
                                        <a href="{{ url('/dashboard') }}" wire:navigate
                                            class="mt-10 block w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('register') }}" wire:navigate
                                            class="mt-10 block w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Get Started
                                        </a>
                                    @endauth
                                    <p class="mt-6 text-xs/5 text-gray-600">
                                        No monthly fees. Cancel anytime.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl p-2">
                            <div class="rounded-2xl p-8 ring-1 ring-gray-200" x-data="{ amount: 50 }">
                                <h3 id="tier-hobby" class="text-lg/8 font-semibold text-gray-900">
                                    Estimate Your Fees
                                </h3>
                                <p class="mt-4 text-sm/6 text-gray-600">
                                    Simulate how much you will pay to get started, for standard European Economic Area
                                    cards.
                                </p>
                                <p class="mt-6 flex items-baseline">
                                    <span class="text-4xl text-gray-600">€</span>
                                    <span class="text-4xl font-semibold">
                                        <input type="number" step="0.01" min="0" x-model="amount"
                                            :style="'width: ' + ((amount || '').length + 1) + 'ch'"
                                            class="w-16 bg-transparent border-none text-gray-700 py-2 px-2 leading-tight focus:border-indigo-500 focus:ring-indigo-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            placeholder="price" aria-label="price">
                                    </span>
                                    <span class="text-sm/6 font-semibold text-gray-600">/transaction</span>
                                </p>
                                <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600">
                                    <li class="flex gap-x-3">
                                        €<span x-text="(amount * 0.01).toFixed(2)"></span>
                                        QuickTapPay Fee (1%)
                                    </li>
                                    <li class="flex gap-x-3">
                                        €<span x-text="(amount * 0.015 + 0.25).toFixed(2)"></span>
                                        Stripe Fee (EEA) - 1.5% + €0.25
                                    </li>
                                    <li class="flex gap-x-3">
                                        €<span
                                            x-text="(amount - (amount * 0.01) - (amount * 0.015 + 0.25)).toFixed(2)"></span>
                                        You Receive (Net)
                                    </li>
                                </ul>
                                <p class="mt-6 text-sm/6 text-gray-600">
                                    For a complete list of charges and details please visit <a class="text-indigo-600"
                                        href="https://stripe.com/ie/pricing" target="_blank">Stripe</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="aspect-[3/2] object-cover lg:aspect-auto lg:size-full"
                src="https://images.unsplash.com/photo-1458819714733-e5ab3d536722?q=80&w=1587&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="{{ config('app.name') }}">
        </div>
    </div>

@endsection
