<section class="w-full">
    @include('partials.stripe-heading')

    <x-stripe.layout :heading="__('Stripe')" :subheading="__('Connect or manage your Stripe account')">
        <div class="my-6 w-full space-y-6">
            @if ($connected)
                <div class="p-4 border rounded bg-green-50 dark:bg-green-900 dark:text-white">
                    <p class="text-sm">Your Stripe account is currently <strong>connected</strong>.</p>
                </div>

                @if(!auth()->user()->stripe_ready)
                <div class="p-4 border rounded bg-orange-50 dark:bg-orange-900 dark:text-white">
                        <p class="text-sm mt-2">Your Stripe account is not yet ready to accept payments, please contact Stripe.</p>
                </div>
                @endif

                <div class="flex gap-4">
                    <flux:modal.trigger name="confirm-stripe-disconnect">
                        <flux:button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-stripe-disconnect')">
                            {{ __('Disconnect') }}
                        </flux:button>
                    </flux:modal.trigger>
                    <flux:modal name="confirm-stripe-disconnect" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
                        <form action="{{ route('stripe.disconnect') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <flux:heading size="lg">{{ __('Are you sure you want to disconnect your Stripe account?') }}</flux:heading>

                                <flux:subheading>
                                    {{ __('Once your account is disconnected, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently disconnect your Stripe account.') }}
                                </flux:subheading>
                            </div>

                            <flux:input wire:model="password" :label="__('Password')" type="password" />

                            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                                <flux:modal.close>
                                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                                </flux:modal.close>

                                <flux:button variant="danger" type="submit">{{ __('Disconnect account') }}</flux:button>
                            </div>
                        </form>
                    </flux:modal>

                    <flux:modal.trigger name="confirm-stripe-delete">
                        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-stripe-delete')">
                            {{ __('Delete Stripe Account') }}
                        </flux:button>
                    </flux:modal.trigger>
                    <flux:modal name="confirm-stripe-delete" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
                        <form action="{{ route('stripe.delete') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <flux:heading size="lg">{{ __('Are you sure you want to delete your Stripe account?') }}</flux:heading>

                                <flux:subheading>
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your Stripe account.') }}
                                </flux:subheading>
                            </div>

                            <flux:input wire:model="password" :label="__('Password')" type="password" />

                            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                                <flux:modal.close>
                                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                                </flux:modal.close>

                                <flux:button variant="danger" type="submit">{{ __('Disconnect account') }}</flux:button>
                            </div>
                        </form>
                    </flux:modal>
                </div>
            @else
                <div class="p-4 border rounded bg-yellow-50 dark:bg-yellow-900 dark:text-white">
                    <p class="text-sm">You haven’t connected a Stripe account yet.</p>
                </div>

                <flux:button wire:click="connect" variant="primary">
                    {{ __('Connect with Stripe') }}
                </flux:button>
            @endif

            @if (session()->has('success'))
                <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                    {{ session('success') }}
                </flux:text>
            @endif

            @if (session()->has('error'))
                <flux:text class="mt-2 font-medium !dark:text-red-400 !text-red-600">
                    {{ session('error') }}
                </flux:text>
            @endif
        </div>
    </x-stripe.layout>
</section>
