<section class="w-full">
    @include('partials.members-heading')

    <x-members.layout :heading="__('Team Members')" :subheading="$business->name" :business="$business">
        {{-- Flash messages --}}
        @if (session('success'))
            <flux:text class="text-green-600 dark:text-green-400 font-medium">{{ session('success') }}</flux:text>
        @endif

        {{-- Invite Form --}}
        <form wire:submit.prevent="invite" class="space-y-6 mb-8">
            <flux:input wire:model.defer="name" :label="__('Name')" type="text" required autofocus />
            <flux:input wire:model.defer="email" :label="__('Email')" type="email" required />

            <div>
                <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">{{ __('Role') }}</label>
                <select wire:model.defer="role" class="w-full rounded-md border-neutral-300 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="member">{{ __('Member') }}</option>
                    <option value="admin">{{ __('Admin') }}</option>
                </select>
            </div>

            <flux:button variant="primary" type="submit">{{ __('Invite User') }}</flux:button>
        </form>
    </x-members.layout>
</section>
