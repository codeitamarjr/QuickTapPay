<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" sizes="any">
    <link rel="icon"type="image/svg+xml" href="{{ asset('/favicon/favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('/favicon/apple-touch-icon.png') }}" sizes="180x180">
    <link rel="manifest" href="{{ asset('/favicon/site.webmanifest') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-zinc-800">
    <header class="absolute inset-x-0 top-0 z-50">
        <div class="mx-auto max-w-7xl">
            <div class="px-6 pt-6 lg:max-w-2xl lg:pl-8 lg:pr-0">
                <nav class="flex items-center justify-between lg:justify-start" aria-label="Global">
                    <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                        <span class="sr-only">{{ config('app.name') }}</span>
                        <img alt="{{ config('app.name') }}" class="h-8 w-auto"
                            src="{{ asset('/favicon/favicon.svg') }}">
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700 lg:hidden">
                        <span class="sr-only">Open main menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div class="hidden lg:ml-12 lg:flex lg:gap-x-14">
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Product</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Features</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Marketplace</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Company</a>
                        @if (Route::has('login'))
                            <nav class="flex items-center justify-end gap-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm/6 font-semibold text-gray-900">Log in</a>
                                @endauth
                            </nav>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" x-data="{ navigationBar: true }">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <div class="fixed inset-0 z-50" @click="navigationBar = !navigationBar"></div>
            <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                x-show="navigationBar" x-transition:enter="transform ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transform ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">
                <div class="flex items-center justify-between">
                    <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                        <span class="sr-only">{{ config('app.name') }}</span>
                        <img class="h-8 w-auto" src="{{ asset('/favicon/favicon.svg') }}"
                            alt="{{ config('app.name') }}">
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700"
                        @click="navigationBar = !navigationBar">
                        <span class="sr-only">Close menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Product</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Features</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Marketplace</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Company</a>
                            <a href="{{ route('login') }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log
                                in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="relative">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 lg:w-full lg:max-w-2xl">
                <svg class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 transform fill-white lg:block"
                    viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="0,0 90,0 50,100 0,100" />
                </svg>

                <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:py-56 lg:pr-0">
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                        <div class="hidden sm:mb-10 sm:flex">
                            <div
                                class="relative rounded-full px-3 py-1 text-sm/6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                                Lauching soon
                                <a href="#" class="whitespace-nowrap font-semibold text-indigo-600"><span
                                        class="absolute inset-0" aria-hidden="true"></span>Read more <span
                                        aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                        <h1 class="text-pretty text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                            Quick Payments. Seamless Experience.
                        </h1>
                        <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                            Quick Tap Pay helps service providers generate instant Stripe-powered payment links. Track
                            sales, manage transactions, and get paid with ease.
                        </p>
                        <ul class="mt-6 space-y-1 text-base text-gray-700">
                            <li>✔ Create & share one-click payment links</li>
                            <li>✔ Accept payments securely with Stripe</li>
                            <li>✔ Track successful and failed transactions</li>
                            <li>✔ Vendor dashboard to manage your earnings</li>
                            <li>✔ Stripe Connect integration – no compliance hassle</li>
                        </ul>
                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="{{ route('register') }}"
                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Get tarted
                            </a>
                            <a href="#" class="text-sm/6 font-semibold text-gray-900">Learn more <span
                                    aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="aspect-[3/2] object-cover lg:aspect-auto lg:size-full"
                src="https://images.unsplash.com/photo-1483389127117-b6a2102724ae?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1587&q=80"
                alt="">
        </div>
    </div>
    @livewireScripts
</body>

</html>
