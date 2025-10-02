@extends('components.layouts.landing.layout')
@section('title', 'Welcome to Quick Tap Pay')
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
                        <h1 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                            Learn More About Quick Tap Pay
                        </h1>

                        <p class="mt-6 text-lg text-gray-600">
                            Quick Tap Pay helps you accept payments effortlessly by generating simple, shareable payment links — with zero code and full Stripe integration.
                        </p>

                        <section class="mt-10 space-y-8 text-gray-700">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">What is Quick Tap Pay?</h2>
                                <p class="mt-2">
                                    Quick Tap Pay is a lightweight payment tool designed for freelancers, service providers, and small businesses. Instead of building a complex payment system, you create a link, share it, and get paid instantly via Stripe.
                                </p>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Who is it for?</h2>
                                <ul class="mt-2 list-disc pl-6 space-y-1">
                                    <li>Freelancers charging for services</li>
                                    <li>Landlords collecting application or reference fees</li>
                                    <li>Professionals offering one-time bookings (e.g. massage, tutoring, consulting)</li>
                                    <li>Any individual or team that needs fast, no-fuss payments</li>
                                </ul>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">How Does It Work?</h2>
                                <ol class="mt-2 list-decimal pl-6 space-y-1">
                                    <li>Sign up and create your business profile</li>
                                    <li>Connect your Stripe account securely</li>
                                    <li>Create a payment link with a title, amount, and optional description</li>
                                    <li>Share the link via email, text, or anywhere online</li>
                                    <li>Receive payments directly into your Stripe account</li>
                                </ol>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">What Makes It Different?</h2>
                                <ul class="mt-2 list-disc pl-6 space-y-1">
                                    <li>No coding or setup headaches</li>
                                    <li>Fully Stripe-powered, so funds are yours instantly</li>
                                    <li>Clear, simple interface and low fees</li>
                                    <li>Great for one-time or occasional payments</li>
                                </ul>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">How Much Does It Cost?</h2>
                                <p class="mt-2">
                                    We charge a small platform fee per successful payment, visible upfront when creating a link. Stripe also applies its standard processing fee. There are no hidden fees or monthly charges.
                                </p>
                            </div>
                        </section>

                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="{{ route('register') }}"
                                class="rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Get Started
                            </a>
                            <a href="{{ route('home') }}" wire:navigate class="text-sm font-semibold text-gray-900">
                                Back to Home <span aria-hidden="true">→</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="aspect-[3/2] object-cover lg:aspect-auto lg:size-full"
                src="{{ asset('/images/hero-about.avif') }}"
                alt="Quick Tap Pay Info">
        </div>
    </div>

@endsection
