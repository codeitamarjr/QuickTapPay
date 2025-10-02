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
                            Quick Tap Pay is Live 🎉
                        </h1>

                        <p class="mt-6 text-lg text-gray-600">
                            A simple, fast, and secure way to create payment links, get paid instantly, and manage your
                            sales — all powered by Stripe.
                        </p>

                        <div class="mt-10 space-y-6 text-gray-700">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Why Quick Tap Pay?</h2>
                                <ul class="mt-4 list-disc pl-6 space-y-2">
                                    <li>Create and share payment links in seconds</li>
                                    <li>Instant payouts through your own Stripe account</li>
                                    <li>No complicated setup — just tap, share, and get paid</li>
                                    <li>Track your earnings with a clean, modern dashboard</li>
                                </ul>
                            </div>

                            <div class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">Perfect For:</h2>
                                <ul class="mt-4 list-disc pl-6 space-y-2">
                                    <li>Freelancers & Consultants</li>
                                    <li>Landlords & Service Providers</li>
                                    <li>Small Businesses & Solo Entrepreneurs</li>
                                    <li>Anyone who wants to get paid fast and easy</li>
                                </ul>
                            </div>

                            <div class="mt-8">
                                <h2 class="text-xl font-semibold text-gray-900">How to Get Started</h2>
                                <ol class="mt-4 list-decimal pl-6 space-y-2">
                                    <li>Create a free account</li>
                                    <li>Set up your business profile</li>
                                    <li>Connect your Stripe account</li>
                                    <li>Start sending payment links and collecting cash</li>
                                </ol>
                            </div>
                        </div>

                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="{{ route('register') }}"
                                class="rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Get Started
                            </a>
                            <a href="{{ route('learn.more') }}" wire:navigate class="text-sm font-semibold text-gray-900">
                                Learn More <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="aspect-[3/2] object-cover lg:aspect-auto lg:size-full"
                src="{{ asset('/images/hero-available.avif') }}"
                alt="Quick Tap Pay Illustration">
        </div>
    </div>

@endsection
