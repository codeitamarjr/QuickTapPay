<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name') }} | Terms & Privacy</title>

    <link rel="icon" type="image/png" href="{{ asset('/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/svg+xml" href="{{ asset('/favicon/favicon.svg') }}" type="image/svg+xml">
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
                    <div class="hidden lg:ml-12 lg:flex lg:gap-x-14">
                        <a href="{{ route('terms') }}" class="text-sm/6 font-semibold text-gray-900">Terms</a>
                        <a href="{{ route('privacy') }}" class="text-sm/6 font-semibold text-gray-900">Privacy</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="relative">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 lg:w-full lg:max-w-2xl">
                <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:py-50 lg:pr-0">
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                        <h1 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">
                            Terms of Service
                        </h1>

                        <div class="mt-6 text-lg text-gray-600">
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900">Last updated: 01/05/2025</h2>
                                <p class="mt-4">
                                    Welcome to Quick Tap Pay. By using our platform, you agree to the following terms.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">1. Service Description</h2>
                                <p class="mt-4">
                                    Quick Tap Pay allows vendors to create simple payment links and receive payments via Stripe. We act as a marketplace facilitator and payment platform.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">2. Accounts</h2>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>You must be at least 18 years old</li>
                                    <li>Provide accurate information</li>
                                    <li>Maintain the confidentiality of your login credentials</li>
                                </ul>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">3. Stripe Connect</h2>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>If you collect payments, you must connect your own Stripe Express account</li>
                                    <li>You agree to Stripe’s <a href="https://stripe.com/connect-account/legal" class="text-indigo-600" target="_blank">Connected Account Agreement</a></li>
                                    <li>You authorize us to deduct our platform fee from each transaction</li>
                                </ul>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">4. Fees</h2>
                                <p class="mt-4">
                                    We charge a percentage-based fee on each successful transaction. The amount is shown in your dashboard. Stripe may charge additional processing fees.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">5. Refunds</h2>
                                <p class="mt-4">
                                    Refunds are your responsibility as a vendor. You may issue refunds via your Stripe Dashboard. We do not refund platform fees unless required by law.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">6. Prohibited Use</h2>
                                <p class="mt-4">
                                    You agree not to use Quick Tap Pay to:
                                </p>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>Violate laws or third-party rights</li>
                                    <li>Sell illegal or regulated products</li>
                                    <li>Engage in fraud or money laundering</li>
                                </ul>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">7. Termination</h2>
                                <p class="mt-4">
                                    We reserve the right to suspend or terminate your account for violations of these terms or misuse of the platform.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">8. Limitation of Liability</h2>
                                <p class="mt-4">
                                    We are not liable for indirect, incidental, or punitive damages related to the use of our services.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">9. Changes to Terms</h2>
                                <p class="mt-4">
                                    We may update these Terms. Continued use of the platform means you accept the new terms.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">10. Contact</h2>
                                <p class="mt-4">
                                    If you have any questions, contact:<br>
                                    <strong>Quick Tap Pay</strong><br>
                                    34a Patrician Villas, Stillorgan - Dublin A94VW74<br>
                                    Email: <a href="mailto:hello@itjunior.dev" class="text-indigo-600">hello@itjunior.dev</a>
                                </p>
                            </section>
                        </div>

                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="{{ route('home') }}"
                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>
