<div class="mx-auto flex w-full max-w-4xl flex-col gap-10 py-10">
    <div class="space-y-2">
        <flux:heading size="xl" level="1">{{ __('Let’s finish setting up your account') }}</flux:heading>
        <flux:subheading size="lg">
            {{ __('Complete the steps below so you can start creating payment links and getting paid.') }}
        </flux:subheading>
    </div>

    @php
        $businessStepActive = $step === 'business';
        $stripeStepActive = $step === 'stripe';
        $paymentLinkStepActive = $step === 'payment-link';
        $businessClasses = $hasBusiness
            ? 'bg-green-600 text-white'
            : ($businessStepActive ? 'bg-blue-600 text-white' : 'bg-neutral-200 text-neutral-700 dark:bg-neutral-700 dark:text-neutral-200');
        $stripeClasses = $stripeConnected
            ? 'bg-green-600 text-white'
            : ($stripeStepActive ? 'bg-blue-600 text-white' : 'bg-neutral-200 text-neutral-700 dark:bg-neutral-700 dark:text-neutral-200');
        $paymentLinkClasses = $hasPaymentLink
            ? 'bg-green-600 text-white'
            : ($paymentLinkStepActive ? 'bg-blue-600 text-white' : 'bg-neutral-200 text-neutral-700 dark:bg-neutral-700 dark:text-neutral-200');
        $completeClasses = $stripeConnected && $hasBusiness && $hasPaymentLink
            ? 'bg-green-600 text-white'
            : 'bg-neutral-200 text-neutral-700 dark:bg-neutral-700 dark:text-neutral-200';
    @endphp

    <div class="flex flex-col gap-4">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3">
                <span class="flex size-9 items-center justify-center rounded-full font-semibold {{ $businessClasses }}">1</span>
                <span class="text-sm font-medium">{{ __('Create a business') }}</span>
            </div>

            <div class="h-px flex-1 bg-neutral-200 dark:bg-neutral-700"></div>

            <div class="flex items-center gap-3">
                <span class="flex size-9 items-center justify-center rounded-full font-semibold {{ $stripeClasses }}">2</span>
                <span class="text-sm font-medium">{{ __('Connect Stripe') }}</span>
            </div>

            <div class="h-px flex-1 bg-neutral-200 dark:bg-neutral-700"></div>

            <div class="flex items-center gap-3">
                <span class="flex size-9 items-center justify-center rounded-full font-semibold {{ $paymentLinkClasses }}">3</span>
                <span class="text-sm font-medium">{{ __('Create a payment link') }}</span>
            </div>

            <div class="h-px flex-1 bg-neutral-200 dark:bg-neutral-700"></div>

            <div class="flex items-center gap-3">
                <span class="flex size-9 items-center justify-center rounded-full font-semibold {{ $completeClasses }}">4</span>
                <span class="text-sm font-medium">{{ __('Start selling') }}</span>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        @if (session()->has('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900 dark:bg-red-950 dark:text-red-200">
                {{ session('error') }}
            </div>
        @endif

        @if ($step === 'business')
            <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                <div class="space-y-2">
                    <flux:heading size="lg">{{ __('Create your business profile') }}</flux:heading>
                    <flux:subheading>
                        {{ __('We use this information on your payment links and receipts. You can edit it later from your settings.') }}
                    </flux:subheading>
                </div>

                <div class="mt-6">
                    <livewire:business-create :onboarding="true" :redirect-to="route('onboarding', ['step' => 'stripe'])" />
                </div>
            </div>
        @elseif ($step === 'stripe')
            <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                <div class="space-y-3">
                    <flux:heading size="lg">{{ __('Connect your Stripe account') }}</flux:heading>
                    <flux:subheading>
                        {{ __('Quick Tap Pay uses Stripe Connect so funds land directly in your account. You’ll be redirected to Stripe to finish this step.') }}
                    </flux:subheading>
                </div>

                <ul class="mt-4 space-y-2 text-sm text-neutral-600 dark:text-neutral-300">
                    <li>• {{ __('Have your Stripe login details ready. You can create a new Stripe account during the process if needed.') }}</li>
                    <li>• {{ __('Once connected, you’ll be sent back here automatically.') }}</li>
                </ul>

                <div class="mt-6">
                    <flux:button variant="primary" wire:click="connectStripe">
                        {{ __('Connect with Stripe') }}
                    </flux:button>
                </div>
            </div>
        @elseif ($step === 'payment-link')
            <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                <div class="space-y-3">
                    <flux:heading size="lg">{{ __('Create your first payment link') }}</flux:heading>
                    <flux:subheading>
                        {{ __('Share this link with customers so you can start taking payments right away.') }}
                    </flux:subheading>
                </div>

                <ul class="mt-4 space-y-2 text-sm text-neutral-600 dark:text-neutral-300">
                    <li>• {{ __('Set a clear title and amount—this appears on the checkout page and receipts.') }}</li>
                    <li>• {{ __('You can always create more links later from your dashboard.') }}</li>
                </ul>

                <div class="mt-6">
                    @if ($primaryBusiness)
                        <livewire:payment.payment-link-create
                            :business="$primaryBusiness"
                            :onboarding="true"
                            :redirect-to="route('onboarding', ['step' => 'complete'])"
                        />
                    @else
                        <div class="rounded-lg border border-yellow-200 bg-yellow-50 px-4 py-3 text-sm text-yellow-800 dark:border-yellow-900 dark:bg-yellow-950 dark:text-yellow-100">
                            {{ __('Create a business first so we know where to save your payment link.') }}
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="rounded-xl border border-neutral-200 bg-white p-6 text-center shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
                <div class="mx-auto flex size-16 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200">
                    <flux:icon.check class="size-6" />
                </div>
                <flux:heading size="lg" class="mt-4">{{ __('You’re ready to start selling!') }}</flux:heading>
                <flux:subheading class="mt-2">
                    {{ __('Head to your dashboard to share your payment link and track payments as they come in.') }}
                </flux:subheading>

                <div class="mt-6 flex justify-center gap-3">
                    <flux:button :href="route('dashboard')" variant="primary" wire:navigate>
                        {{ __('Go to dashboard') }}
                    </flux:button>
                    <flux:button :href="route('business.index')" variant="ghost" wire:navigate>
                        {{ __('Manage businesses') }}
                    </flux:button>
                </div>
            </div>
        @endif
    </div>
</div>
