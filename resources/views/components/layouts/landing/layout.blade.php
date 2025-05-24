<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

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
                    <a href="{{ route('home') }}" class="-m-1.5 p-1.5" wire:navigate>
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
                    <div class="hidden lg:ml-12 lg:flex lg:gap-x-14 whitespace-nowrap">
                        <a href="{{ route('pricing') }}" class="text-sm/6 font-semibold text-gray-900"
                            wire:navigate>Pricing</a>
                        <a href="{{ route('terms.of.service') }}" class="text-sm/6 font-semibold text-gray-900"
                            wire:navigate>Terms of Use</a>
                        <a href="{{ route('privacy.policy') }}" class="text-sm/6 font-semibold text-gray-900"
                            wire:navigate>Privacy Policy</a>
                        @if (Route::has('login'))
                            <nav class="flex items-center justify-end gap-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="text-sm/6 font-semibold text-gray-900">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm/6 font-semibold text-gray-900">Log
                                        in</a>
                                @endauth
                            </nav>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" x-data="{ navigationBar: false }">
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
                            <a href="{{ route('pricing') }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Pricing</a>
                            <a href="{{ route('terms.of.service') }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Terms</a>
                            <a href="{{ route('privacy.policy') }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Privacy</a>
                            <a href="{{ route('vendor.disclaimer') }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Vendor</a>
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                                    Log in</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content Here -->
    @yield('content')

    <footer class="bg-white border-t mt-auto">
    <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-500 text-center space-y-2">
        <nav class="space-x-4">
            <a href="{{ route('pricing') }}" class="text-md hover:text-indigo-600 transition">Pricing</a>
            <a href="{{ route('privacy.policy') }}" class="text-md hover:text-indigo-600 transition">Privacy Policy</a>
            <a href="{{ route('terms.of.service') }}" class="text-md hover:text-indigo-600 transition">Terms of Service</a>
            <a href="{{ route('vendor.disclaimer') }}" class="text-md hover:text-indigo-600 transition">Vendor Disclaimer</a>
        </nav>
        <div>
            &copy; {{ now()->year }} {{ config('app.name', 'QuickTapPay') }}. All rights reserved.
        </div>
    </div>
</footer>

    @livewireScripts
</body>

</html>
