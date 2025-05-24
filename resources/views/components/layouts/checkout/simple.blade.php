<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Checkout' }} | {{ config('app.name', 'QuickTapPay') }}</title>
    <meta name="description" content="{{ $description ?? 'Secure and fast checkout powered by QuickTapPay.' }}" />

    <link rel="icon" type="image/png" href="{{ asset('/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" sizes="any">
    <link rel="icon"type="image/svg+xml" href="{{ asset('/favicon/favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('/favicon/apple-touch-icon.png') }}" sizes="180x180">
    <link rel="manifest" href="{{ asset('/favicon/site.webmanifest') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="h-full antialiased text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @isset($logo)
                        <div class="h-8 w-8 shrink-0 overflow-hidden rounded-md">
                            {!! $logo !!}
                        </div>
                    @endisset
                    <div>
                        <div class="text-lg font-semibold text-gray-700">
                            {{ $title ?? 'Business Checkout' }}
                        </div>
                        @isset($description)
                            <div class="text-sm text-gray-500">{{ $description }}</div>
                        @endisset
                    </div>
                </div>
                <div class="text-sm text-gray-400">
                    Powered by {{ config('app.name', 'QuickTapPay') }}
                </div>
            </div>
        </header>

        <!-- Main content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t mt-8">
            <div class="max-w-7xl mx-auto py-6 px-4 text-sm text-gray-500 text-center space-y-2">
                <div class="space-x-4">
                    <a href="{{ route('privacy.policy') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
                    <a href="{{ route('terms.of.service') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Terms of Service</a>
                    <a href="{{ route('vendor.disclaimer') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Vendor Disclaimer</a>
                </div>
                <div>
                    &copy; {{ now()->year }} {{ config('app.name', 'QuickTapPay') }}. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>

</html>
