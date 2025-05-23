<div class="flex flex-col justify-between h-full w-full p-4 bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
    <img src="{{ asset('/icons/stripe.svg') }}" alt="Stripe" class="size-20" />
    <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Stripe Integration</h5>

    @if (auth()->user()->stripe_account_id)
        <p class="font-normal text-green-600 dark:text-green-400">
            Stripe account connected successfully.
        </p>

        <form action="{{ route('stripe.disconnect') }}" method="POST">
            @csrf
            <button type="submit"
                class="inline-flex font-medium items-center text-red-600 hover:underline">
                Disconnect
                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </form>
    @else
        <p class="font-normal text-gray-500 dark:text-gray-400">
            Connect your Stripe account to start receiving payments.
        </p>

        <a href="{{ route('stripe.connect') }}"
            class="inline-flex font-medium items-center text-blue-600 hover:underline">
            Connect
            <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
            </svg>
        </a>
    @endif
</div>
