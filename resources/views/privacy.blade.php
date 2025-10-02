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
                        <h1 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">
                            Privacy Policy
                        </h1>

                        <div class="mt-6 text-lg text-gray-600">
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900">Last updated: 01/05/2025</h2>
                                <p class="mt-4">
                                    Quick Tap Pay ("we", "our", or "us") is committed to protecting your privacy. This
                                    Privacy Policy explains how we collect, use, share, and protect your personal
                                    information when you use our platform at quicktappay.com.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">1. What Data We Collect</h2>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>Name, email, phone number</li>
                                    <li>Business name and website</li>
                                    <li>Payment information (via Stripe)</li>
                                    <li>IP address, browser type, and usage data</li>
                                </ul>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">2. How We Use Your Data</h2>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>Provide our services</li>
                                    <li>Process payments through Stripe</li>
                                    <li>Manage user accounts and Stripe Connect onboarding</li>
                                    <li>Send administrative emails or support responses</li>
                                    <li>Comply with legal obligations</li>
                                </ul>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">3. Sharing Your Information</h2>
                                <p class="mt-4">
                                    We share data with:
                                </p>
                                <ul class="mt-4 list-disc pl-6">
                                    <li><strong>Stripe</strong> (to process payments and onboard vendors) - Stripe acts
                                        as our payment processor and is GDPR-compliant</li>
                                    <li>Legal authorities, only if required by law</li>
                                </ul>
                                <p class="mt-4">
                                    We do not sell your data.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">4. Stripe Connect</h2>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>Your data is securely shared with Stripe to create a connected account.</li>
                                    <li>Stripe is responsible for verifying your identity and managing payouts.</li>
                                    <li>Learn more in <a href="https://stripe.com/privacy" class="text-indigo-600"
                                            target="_blank">Stripe’s Privacy Policy</a></li>
                                </ul>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">5. Data Retention</h2>
                                <p class="mt-4">
                                    We retain your data only as long as needed for:
                                </p>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>Providing services</li>
                                    <li>Legal/accounting requirements</li>
                                    <li>Platform protection</li>
                                </ul>
                                <p class="mt-4">
                                    Inactive accounts may be deleted or anonymized after 12 months.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">6. Your Rights</h2>
                                <p class="mt-4">
                                    You have the right to:
                                </p>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>Access your data</li>
                                    <li>Request correction or deletion</li>
                                    <li>Object to processing</li>
                                    <li>Request data portability</li>
                                </ul>
                                <p class="mt-4">
                                    To make a request, email <a href="mailto:hello@itjunior.dev"
                                        class="text-indigo-600">hello@itjunior.dev</a>.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">7. Data Security</h2>
                                <p class="mt-4">
                                    We implement technical and organizational measures to protect your data. All Stripe
                                    payment data is handled using PCI-compliant services.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">8. Contact</h2>
                                <p class="mt-4">
                                    For any privacy concerns, contact:<br>
                                    <strong>Quick Tap Pay</strong><br>
                                    34a Patrician Villas, Stillorgan - Dublin A94VW74<br>
                                    Email: <a href="mailto:hello@itjunior.dev"
                                        class="text-indigo-600">hello@itjunior.dev</a>
                                </p>
                            </section>
                        </div>

                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="{{ route('home') }}" wire:navigate
                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="aspect-[3/2] object-cover lg:aspect-auto lg:size-full"
                src="{{ asset('/images/hero-privacy.avif') }}"
                alt="{{ config('app.name') }}">
        </div>
    </div>

@endsection
