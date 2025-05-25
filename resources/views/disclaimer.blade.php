@extends('components.layouts.landing.layout')
@section('title', 'Vendor Disclaimer')
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
                            Vendor Disclaimer
                        </h1>

                        <div class="mt-6 text-lg text-gray-600">
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900">Last updated: 24/05/2025</h2>
                                <p class="mt-4">
                                    This Vendor Disclaimer outlines the responsibilities and liabilities between Quick Tap Pay, vendors using our platform, and end customers.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">1. Role of Quick Tap Pay</h2>
                                <p class="mt-4">
                                    Quick Tap Pay provides a platform for vendors to create payment links and process payments through Stripe. We are not involved in the actual sale, delivery, quality assurance, or fulfillment of products or services offered by vendors.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">2. Vendor Responsibility</h2>
                                <p class="mt-4">
                                    Vendors are solely responsible for their products, services, pricing, and customer support. This includes:
                                </p>
                                <ul class="mt-4 list-disc pl-6">
                                    <li>Accurate product or service descriptions</li>
                                    <li>Fulfilling customer orders</li>
                                    <li>Managing cancellations, refunds, and disputes</li>
                                    <li>Ensuring legal compliance in their jurisdiction</li>
                                </ul>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">3. Liability Disclaimer</h2>
                                <p class="mt-4">
                                    Quick Tap Pay is not liable for any damages, losses, or disputes arising from the sale or use of vendor products or services. All transactions and interactions are solely between the buyer and the vendor.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">4. Disputes & Chargebacks</h2>
                                <p class="mt-4">
                                    Buyers must contact the vendor directly to resolve any issues. In the case of chargebacks or disputes through Stripe, vendors are responsible for providing evidence and addressing claims.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">5. Communication</h2>
                                <p class="mt-4">
                                    Buyers and vendors are encouraged to communicate directly to resolve issues. Quick Tap Pay does not mediate disputes but may take action against vendors who violate our terms or misuse the platform.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">6. Platform Integrity</h2>
                                <p class="mt-4">
                                    We reserve the right to suspend or remove vendors who engage in fraudulent activity, deliver poor customer experiences, or breach our Terms of Service.
                                </p>
                            </section>

                            <section class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">7. Contact Us</h2>
                                <p class="mt-4">
                                    If you have any questions regarding this disclaimer, please contact us at:<br>
                                    <strong>Quick Tap Pay</strong><br>
                                    34a Patrician Villas, Stillorgan - Dublin A94VW74<br>
                                    Email: <a href="mailto:hello@itjunior.dev" class="text-indigo-600">hello@itjunior.dev</a>
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
                src="https://images.unsplash.com/photo-1596983487641-a97ae9d69bc7?q=80&w=1587&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="{{ config('app.name') }}">
        </div>
    </div>

@endsection
