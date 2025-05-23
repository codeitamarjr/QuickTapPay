<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('business.index')" wire:navigate>{{ __('Manage Businesses') }}
            </flux:navlist.item>
            <flux:navlist.item :href="route('business.create')" wire:navigate>{{ __('Create Business') }}
            </flux:navlist.item>
            {{-- <flux:navlist.item :href="route('business.settings')" wire:navigate>{{ __('Business Settings') }}
            </flux:navlist.item>
            <flux:navlist.item :href="route('business.members')" wire:navigate>{{ __('Business Members') }}
            </flux:navlist.item> --}}
        </flux:navlist>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
