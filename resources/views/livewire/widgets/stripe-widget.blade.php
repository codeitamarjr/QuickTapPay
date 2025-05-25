<div class="flex flex-col justify-between h-full w-full p-4 bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
    <img src="{{ asset('/icons/stripe.svg') }}" alt="Stripe" class="size-20" />
     <p class="block text-slate-600 leading-normal font-light">
        Access your Stripe Account
    </p>
    <a href="{{ $expressDashboardUrl }}" class="inline-flex font-medium items-center text-blue-600 hover:underline"
        target="_blank">
        Open Dashboard
        <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
        </svg>
    </a>
</div>
