<section class="w-full">
    {{-- Page Heading --}}
    @include('partials.payment-links-heading')

    {{-- Main Layout Wrapper --}}
    <x-payment.layout :heading="__('Edit Payment Link')" :subheading="$paymentLink->title" :business="$business">
        {{-- Flash messages --}}
        @if (session('success'))
            <div class="mb-4">
                <x-ui.flash-message type="success" title="Success">
                    {{ session('success') }}
                </x-ui.flash-message>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4">
                <x-ui.flash-message type="error" title="Error">
                    {{ session('error') }}
                </x-ui.flash-message>
            </div>
        @endif
        
        {{-- Edit Payment Link Form --}}
        <form wire:submit.prevent="update" class="my-6 w-full space-y-6">
            <flux:input wire:model.defer="title" :label="__('Service Title')" type="text" required autofocus />
            <flux:select wire:model.defer="currency" :label="__('Currency')" required>
                <option value="EUR">Euro (€)</option>
                <option value="USD">US Dollar ($)</option>
                <option value="GBP">British Pound (£)</option>
                <option value="JPY">Japanese Yen (¥)</option>
                <option value="AUD">Australian Dollar (A$)</option>
                <option value="CAD">Canadian Dollar (C$)</option>
                <option value="CHF">Swiss Franc (CHF)</option>
                <option value="CNY">Chinese Yuan (¥)</option>
            </flux:select>
            <flux:input wire:model.defer="amount" :label="__('Amount (€)')" type="number" step="0.01" required />
            <flux:input wire:model.defer="description" :label="__('Description')" type="text" />

            <div class="flex items-center gap-2">
                <input id="is_active" type="checkbox" wire:model.defer="is_active" class="rounded border-neutral-300">
                <label for="is_active" class="text-sm text-gray-700 dark:text-gray-300">
                    {{ __('Active') }}
                </label>
            </div>

            <flux:button variant="primary" type="submit" class="w-full">
                {{ __('Update') }}
            </flux:button>
        </form>
    </x-payment.layout>
</section>
