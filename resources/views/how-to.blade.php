@extends('components.layouts.landing.layout')
@section('title', 'How Quick Tap Pay Works')
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
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-indigo-600">
                            How-To &amp; FAQ
                        </span>

                        <h1 class="mt-6 text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                            Get paid in minutes with Quick Tap Pay
                        </h1>

                        <p class="mt-6 text-lg text-gray-600">
                            This step-by-step guide shows you how to go from sign-up to sharing your first payment link, with
                            answers to the questions we hear most from new sellers.
                        </p>

                        <section class="mt-10 space-y-8 text-gray-700">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Quick start checklist</h2>
                                <ol class="mt-3 list-decimal space-y-2 pl-6">
                                    <li><strong>Create your account</strong> – sign up with your email and password.</li>
                                    <li><strong>Add your business profile</strong> – share the name, contact details, and
                                        branding customers expect.</li>
                                    <li><strong>Connect Stripe</strong> – follow the Stripe Connect prompts and authorize the
                                        payout account.</li>
                                    <li><strong>Publish your first payment link</strong> – set a title, price, currency, and
                                        optional description.</li>
                                    <li><strong>Share &amp; get paid</strong> – send the link anywhere you talk to clients and
                                        watch funds land in Stripe.</li>
                                </ol>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Onboarding flow in detail</h2>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Business profile</h3>
                                        <p class="mt-1">
                                            We reuse this info on receipts and checkout pages, so it&rsquo;s worth getting it
                                            right. You can update everything later from the dashboard.
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Stripe Connect</h3>
                                        <p class="mt-1">
                                            Stripe handles the secure bits—we never see your banking credentials. Finish their
                                            verification flow and you&rsquo;re ready to accept payments instantly.
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">First payment link</h3>
                                        <p class="mt-1">
                                            The onboarding wizard stays with you until that first link is live. Afterward you
                                            can duplicate links, tweak pricing, and track sales from the dashboard.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Frequently asked questions</h2>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Do I need an existing Stripe account?</h3>
                                        <p class="mt-1">No. You can create one during onboarding—Stripe will guide you through
                                            verification and connect it automatically.</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Can I manage multiple businesses?</h3>
                                        <p class="mt-1">Yes. Add all of your ventures, invite teammates, and keep payment links
                                            organized by brand.</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">How are fees handled?</h3>
                                        <p class="mt-1">You pay Stripe&rsquo;s standard processing fee plus a small Quick Tap Pay
                                            platform fee shown before you publish. There are no subscriptions or hidden charges.</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">What happens after a customer pays?</h3>
                                        <p class="mt-1">Customers receive a Stripe-hosted receipt. You can review every payment
                                            in Quick Tap Pay and in Stripe, including payouts and customer details.</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Need help or have a feature request?</h3>
                                        <p class="mt-1">
                                            Email
                                            <a href="mailto:support@quicktappay.com"
                                                class="font-medium text-indigo-600 hover:text-indigo-500">support@quicktappay.com</a>
                                            and we&rsquo;ll get back to you quickly.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Keep the momentum</h2>
                                <p class="mt-2">
                                    Any time you sign in, a “Get ready to sell” panel on the dashboard highlights the next step
                                    if you still need to finish onboarding—or it links straight to payment link tools once
                                    you&rsquo;re live.
                                </p>
                            </div>
                        </section>

                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="{{ route('register') }}"
                                class="rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Create your account
                            </a>
                            <a href="{{ route('pricing') }}" class="text-sm font-semibold text-gray-900" wire:navigate>
                                View pricing <span aria-hidden="true">→</span>
                            </a>
                        </div>

                        <div class="mt-8 text-sm text-gray-500">
                            Related: <a href="{{ route('learn.more') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-500">What is Quick Tap Pay?</a> ·
                            <a href="{{ route('vendor.disclaimer') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-500">Vendor disclaimer</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="aspect-[3/2] object-cover lg:aspect-auto lg:size-full"
                src="{{ asset('/images/hero-about.avif') }}"
                alt="How to use Quick Tap Pay">
        </div>
    </div>

@endsection
