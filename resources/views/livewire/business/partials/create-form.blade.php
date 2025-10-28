<form wire:submit.prevent="save" class="my-6 w-full space-y-6">
    {{-- Contact Info --}}
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
        @endif
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-neutral-300">
            {{ __('Currency') }}
        </label>
        <select wire:model.defer="currency" class="w-full rounded-md border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800">
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
