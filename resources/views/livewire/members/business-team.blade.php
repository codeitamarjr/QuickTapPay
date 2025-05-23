<section class="w-full">
    @include('partials.members-heading')

    <x-members.layout :heading="__('Team Members')" :subheading="$business->name" :business="$business">
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


        {{-- Members List --}}
        <ul class="space-y-4">
            @foreach ($members as $member)
                @php
                    $isInvited = !empty($member->invitation_token);
                    $statusLabel = $isInvited ? __('Invited') : __('Accepted');
                @endphp
                <li class="flex items-center justify-between border-b pb-2">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $member->name }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $member->email }} &middot; {{ ucfirst(optional($member->pivot)->role) }} &middot;
                            <flux:text color="{{ $isInvited ? 'yellow' : 'green' }}">{{ $statusLabel }}</flux:text>
                        </div>
                    </div>
                    <div>
                        @if ($member->id !== auth()->id())
                            <flux:button size="sm" variant="outline" class="!text-red-600 hover:!bg-red-100"
                                wire:click="confirmDelete({{ $member->id }})">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-3.5 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                    {{ __('Delete') }}
                                </div>
                            </flux:button>
                        @endif
                        @if ($isInvited)
                            <flux:button size="sm" variant="outline"
                                wire:click="resendInvite({{ $member->id }})">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-3.5 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                    {{ __('Resend Invite') }}
                                </div>
                            </flux:button>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

        @if ($confirmingDelete)
            <x-ui.modal wire:model="showDeleteModal">
                <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-red-100">
                    <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-base font-semibold text-gray-900" id="modal-title">
                        {{ __('Delete Member') }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            {{ __('Are you sure you want to delete ":name"? This action cannot be undone.', ['name' => $confirmingDelete->name]) }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                    <flux:button type="button" variant="outline" class="w-full"
                        wire:click="$set('showDeleteModal', false); $set('confirmingDelete', null);">
                        {{ __('Cancel') }}
                    </flux:button>
                    <flux:button type="button" variant="outline" class="!text-red-600 hover:!bg-red-100"
                        wire:click="delete">
                        {{ __('Yes, delete') }}
                    </flux:button>
                </div>
            </x-ui.modal>
        @endif
    </x-members.layout>
</section>
