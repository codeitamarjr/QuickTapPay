<x-layouts.auth.simple>
    <x-slot name="title">
        {{ __('Accept Invitation') }}
    </x-slot>
    <x-slot name="description">
        {{ __('You\'ve been invited to join :business. Please set your password to continue.', [
            'business' => $user->businesses->first()->name ?? 'our platform',
        ]) }}
    </x-slot>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Set your password')" :description="__('You\'ve been invited to join :business. Please set your password to continue.', [
            'business' => $user->businesses->first()->name ?? 'our platform',
        ])" />

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="text-red-600 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('invitation.accept', $user->invitation_token) }}"
            class="flex flex-col gap-6">
            @csrf

            <flux:input :label="__('Password')" name="password" type="password" required autocomplete="new-password"
                placeholder="********" viewable />

            <flux:input :label="__('Confirm Password')" name="password_confirmation" type="password" required
                autocomplete="new-password" placeholder="********" viewable />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">
                    {{ __('Set Password and Continue') }}
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts.auth.simple>
