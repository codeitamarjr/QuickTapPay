<div class="flex h-full w-full flex-col gap-2 rounded-lg border border-indigo-100 bg-white p-3 shadow-sm ring-1 ring-inset ring-indigo-50 dark:border-indigo-400/40 dark:bg-gray-900 dark:ring-indigo-900/40">
    <div class="flex items-center gap-2">
        <div class="shrink-0 rounded-md bg-indigo-50 p-2 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="min-w-0 flex-1">
            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-indigo-600 dark:text-indigo-300">Stripe status</p>
            <p class="text-sm font-semibold leading-snug text-gray-900 dark:text-white">Verification in progress</p>
            <p class="text-[11px] leading-snug text-gray-600 dark:text-gray-300">
                Payments paused until Stripe confirms your account.
            </p>
        </div>
        <span
            class="inline-flex shrink-0 items-center gap-1 rounded-full bg-amber-50 px-2 py-1 text-[11px] font-semibold text-amber-700 ring-1 ring-amber-100 dark:bg-amber-500/10 dark:text-amber-200 dark:ring-amber-400/30">
            <span class="h-2 w-2 rounded-full bg-amber-500"></span> In review
        </span>
    </div>

    <div class="grid gap-2 text-[11px] text-indigo-900 sm:grid-cols-2 dark:text-indigo-100">
        <div class="rounded-md border border-dashed border-indigo-100 bg-indigo-50/70 p-2 leading-snug dark:border-indigo-400/40 dark:bg-indigo-900/30">
            <p class="font-semibold">Do this</p>
            <p>Finish any Stripe tasks.</p>
        </div>
        <div class="rounded-md border border-dashed border-indigo-100 bg-indigo-50/70 p-2 leading-snug dark:border-indigo-400/40 dark:bg-indigo-900/30">
            <p class="font-semibold">Impact</p>
            <p>Links work, payments wait.</p>
        </div>
    </div>

    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-[11px] leading-snug text-gray-500 dark:text-gray-400">
            Open Stripe for required docs.
        </div>
        <a href="{{ route('stripe.connect') }}"
            class="inline-flex items-center justify-center gap-2 rounded-md bg-indigo-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:w-auto w-full">
            Open Stripe setup
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                <path fill-rule="evenodd"
                    d="M3.25 10a.75.75 0 0 1 .75-.75h9.19L10.72 7.78a.75.75 0 0 1 1.06-1.06l3.5 3.5a.75.75 0 0 1 0 1.06l-3.5 3.5a.75.75 0 1 1-1.06-1.06l2.47-2.47H4a.75.75 0 0 1-.75-.75Z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>
