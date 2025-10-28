<div class="space-y-4">
    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900 dark:bg-red-950 dark:text-red-200">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <flux:input wire:model.defer="title" :label="__('Service title')" type="text" required autofocus />
        <flux:input wire:model.defer="amount" :label="__('Amount (€)')" type="number" step="0.01" required />
        <flux:input wire:model.defer="description" :label="__('Description (optional)')" type="text" />
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
        <flux:button variant="primary" type="submit" class="w-full">
            {{ __('Create payment link') }}
        </flux:button>
    </form>
</div>
