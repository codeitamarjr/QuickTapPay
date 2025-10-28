<section class="w-full">
    @include('partials.settings-heading')

    <x-business.layout :heading="__('Edit Business')" :subheading="$business->name">
        <form wire:submit.prevent="update" class="my-6 w-full space-y-6">

            <flux:input wire:model.defer="name" :label="__('Business Name')" type="text" required autofocus />
            <flux:input wire:model.defer="email" :label="__('Email')" type="email" required />
            <flux:input wire:model.defer="phone" :label="__('Phone')" type="text" />

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300">
                    {{ __('Business Logo') }}
                </label>
                <input type="file" wire:model="logoUpload" accept="image/*"
                    class="block w-full cursor-pointer rounded-md border border-dashed border-neutral-300 px-3 py-2 text-sm text-gray-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200" />
                <p class="text-xs text-neutral-500 dark:text-neutral-400">
                    {{ __('Recommended size 400x400px. PNG, JPG, or SVG up to 4MB.') }}
                </p>
                @error('logoUpload')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror

                @if ($logoUpload)
                    <div class="mt-3 flex items-center gap-4">
                        <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Preview') }}</span>
                        <img src="{{ $logoUpload->temporaryUrl() }}" alt="{{ __('Logo preview') }}"
                            class="h-16 w-16 rounded-lg object-cover shadow-sm" />
                    </div>
                @elseif ($logoUrl)
                    <div class="mt-3 flex items-center gap-4">
                        <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ __('Current logo') }}</span>
                        <img src="{{ $logoUrl }}" alt="{{ __('Current business logo') }}"
                            class="h-16 w-16 rounded-lg object-cover shadow-sm" />
                        <button type="button" wire:click="removeLogo"
                            class="inline-flex items-center rounded-md border border-transparent bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                            {{ __('Remove logo') }}
                        </button>
                    </div>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                    {{ __('Currency') }}
                </label>
                <select wire:model.defer="currency"
                    class="w-full rounded-md border-neutral-300 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="EUR">EUR (€)</option>
                    <option value="USD">USD ($)</option>
                    <option value="GBP">GBP (£)</option>
                </select>
            </div>

            <flux:input wire:model.defer="address_line1" :label="__('Address Line 1')" type="text" />
            <flux:input wire:model.defer="address_line2" :label="__('Address Line 2')" type="text" />
            <flux:input wire:model.defer="address_line3" :label="__('Address Line 3')" type="text" />
            <flux:input wire:model.defer="address_line4" :label="__('Address Line 4')" type="text" />
            <flux:input wire:model.defer="city" :label="__('City')" type="text" />
            <flux:input wire:model.defer="postal_code" :label="__('Postal Code')" type="text" />
            <flux:input wire:model.defer="country" :label="__('Country')" type="text" />
            <flux:input wire:model.defer="website" :label="__('Website')" type="text" />

            <flux:input wire:model.defer="vat_number" :label="__('VAT Number')" type="text" />
            <flux:input wire:model.defer="tax_number" :label="__('Tax Number')" type="text" />

            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit" class="w-full">
                    {{ __('Save Changes') }}
                </flux:button>

                <x-action-message class="me-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>

        </form>
    </x-business.layout>
</section>
