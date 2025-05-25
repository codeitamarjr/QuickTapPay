<dl class="mx-auto gap-px sm:grid-cols-2 lg:grid-cols-4">
    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 px-4 py-10 sm:px-6 xl:px-8">
        <dt class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">Total Sales</dt>
        <dd class="text-xs font-medium text-gray-700 dark:text-gray-200">+4.75%</dd>
        <dd class="w-full flex-none text-3xl/10 font-medium tracking-tight text-gray-900 dark:text-gray-200">
            <div>
                {{ Number::currency($topCurrencyTotal, $topCurrency) }}
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">this month</span>
            </div>
        </dd>
    </div>
</dl>
