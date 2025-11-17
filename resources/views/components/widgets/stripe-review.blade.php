<div class="flex h-full w-full flex-col justify-between gap-4 rounded-lg border border-indigo-100 bg-white p-4 shadow-sm ring-1 ring-inset ring-indigo-50 dark:border-indigo-400/40 dark:bg-gray-900 dark:ring-indigo-900/40">
    <div class="flex items-start justify-between">
        <div class="space-y-1">
            <p class="text-xs font-semibold uppercase tracking-[0.15em] text-indigo-600 dark:text-indigo-300">Stripe
                status</p>
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                Verification in progress
            </h5>
            <p class="text-sm text-gray-600 dark:text-gray-300">
                Your Stripe account is still under review, so payments are paused until Stripe finishes verification.
            </p>
        </div>
        <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700 ring-1 ring-amber-100 dark:bg-amber-500/10 dark:text-amber-200 dark:ring-amber-400/30">
            <span class="relative flex h-2 w-2">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex h-2 w-2 rounded-full bg-amber-500"></span>
            </span>
            In review
        </span>
    </div>

    <div class="space-y-2 rounded-md border border-dashed border-indigo-100 bg-indigo-50/70 p-3 text-sm text-indigo-900 dark:border-indigo-400/40 dark:bg-indigo-900/30 dark:text-indigo-100">
        <p class="font-semibold">What to expect</p>
        <ul class="list-disc space-y-1 pl-5">
            <li>Stripe may ask for extra details; complete them to unlock payouts.</li>
            <li>Customers can view payment links but cannot pay until this clears.</li>
        </ul>
    </div>

    <div class="flex items-center justify-between">
        <div class="text-xs text-gray-500 dark:text-gray-400">
            Need help? Check your Stripe dashboard for pending actions.
        </div>
        <a href="{{ route('stripe.connect') }}"
            class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Open Stripe setup
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                <path fill-rule="evenodd"
                    d="M3.25 10a.75.75 0 0 1 .75-.75h9.19L10.72 7.78a.75.75 0 0 1 1.06-1.06l3.5 3.5a.75.75 0 0 1 0 1.06l-3.5 3.5a.75.75 0 1 1-1.06-1.06l2.47-2.47H4a.75.75 0 0 1-.75-.75Z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>
