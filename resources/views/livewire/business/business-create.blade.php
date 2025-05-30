<section class="w-full">
    {{-- Page Heading --}}
    @include('partials.business-heading')

    {{-- Main Layout Wrapper --}}
    <x-business.layout :heading="__('Create Business')" :subheading="__('Set up your business information to start collecting payments.')">
        <form wire:submit.prevent="save" class="my-6 w-full space-y-6">

            {{-- Contact Info --}}
            <flux:input wire:model.defer="name" :label="__('Business Name')" type="text" required autofocus />
            <flux:input wire:model.defer="email" :label="__('Email')" type="email" required />
            <flux:input wire:model.defer="phone" :label="__('Phone')" type="text" />
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                    {{ __('Currency') }}
                </label>
                <select wire:model.defer="currency" class="w-full rounded-md border-neutral-300 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="EUR">EUR (€)</option>
                    <option value="USD">USD ($)</option>
                    <option value="GBP">GBP (£)</option>
                </select>
            </div>

            {{-- Address Info --}}
            <flux:input wire:model.defer="address_line1" :label="__('Address Line 1')" type="text" />
            <flux:input wire:model.defer="address_line2" :label="__('Address Line 2')" type="text" />
            <flux:input wire:model.defer="address_line3" :label="__('Address Line 3')" type="text" />
            <flux:input wire:model.defer="address_line4" :label="__('Address Line 4')" type="text" />
            <flux:input wire:model.defer="city" :label="__('City')" type="text" />
            <flux:input wire:model.defer="postal_code" :label="__('Postal Code')" type="text" />
            <flux:input wire:model.defer="country" :label="__('Country')" type="text" />
            <flux:input wire:model.defer="website" :label="__('Website')" type="text" />

            {{-- Tax Details --}}
            <flux:input wire:model.defer="vat_number" :label="__('VAT Number')" type="text" />
            <flux:input wire:model.defer="tax_number" :label="__('Tax Number')" type="text" />

            {{-- Actions --}}
            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit" class="w-full">
                    {{ __('Create Business') }}
                </flux:button>

                <x-action-message class="me-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>

        </form>
    </x-business.layout>
</section>
