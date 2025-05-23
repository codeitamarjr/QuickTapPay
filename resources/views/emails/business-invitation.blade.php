@component('mail::message')
    # 👋 You're invited to join {{ $business->name }}

    {{ $inviter->name }} ({{ $inviter->email }}) has invited you to join the business **{{ $business->name }}** on
    QuickTapPay as a **{{ ucfirst($role) }}**.

    @component('mail::button', ['url' => $actionUrl])
        Accept Invitation
    @endcomponent

    If you already have an account, just click the button and log in.

    If you're new, you’ll be prompted to set your password.

    Thanks,
    {{ config('app.name') }}
@endcomponent
