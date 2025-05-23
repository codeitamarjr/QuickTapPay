 <div>
     <x-slot name="logo">
         @if ($link->business->logo)
             <img src="{{ asset('storage/' . $link->business->logo) }}" alt="{{ $link->business->name }}"
                 class="h-8 w-auto" />
         @endif
     </x-slot>

     <x-slot name="title">{{ $link->business->name ?? 'Checkout' }}</x-slot>

     <x-slot name="description">
         {{ __('Secure payment for :service', ['service' => $link->title]) }}
     </x-slot>

     <div class="bg-gray-50">
         <div class="max-w-2xl mx-auto px-4 py-16 sm:px-6 lg:max-w-4xl lg:px-8 text-center">
             <div class="mb-8">
                 <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="M9 12l2 2l4 -4M12 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10s-4.48 10-10 10z" />
                 </svg>
                 <h2 class="mt-4 text-2xl font-bold text-gray-900">Payment Successful</h2>
                 <p class="mt-2 text-sm text-gray-600">
                     Thank you for your payment. We’ve sent a confirmation to your email.
                 </p>
             </div>

             <div class="bg-white rounded-lg shadow p-6 text-left">
                 <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Details</h3>
                 <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                     <div>
                         <dt class="text-sm font-medium text-gray-500">Name</dt>
                         <dd class="mt-1 text-sm text-gray-900">{{ $sale->name }}</dd>
                     </div>
                     <div>
                         <dt class="text-sm font-medium text-gray-500">Email</dt>
                         <dd class="mt-1 text-sm text-gray-900">{{ $sale->email }}</dd>
                     </div>
                     <div>
                         <dt class="text-sm font-medium text-gray-500">Phone</dt>
                         <dd class="mt-1 text-sm text-gray-900">{{ $sale->phone }}</dd>
                     </div>
                     <div>
                         <dt class="text-sm font-medium text-gray-500">Reference</dt>
                         <dd class="mt-1 text-sm text-gray-900">{{ $sale->reference ?? '-' }}</dd>
                     </div>
                     <div>
                         <dt class="text-sm font-medium text-gray-500">Amount Paid</dt>
                         <dd class="mt-1 text-sm text-gray-900">
                             {{ Number::currency($sale->amount, $sale->currency) }}
                         </dd>
                     </div>
                     <div>
                         <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                         <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($sale->payment_method) }}</dd>
                     </div>
                     <div class="sm:col-span-2">
                         <dt class="text-sm font-medium text-gray-500">Transaction ID</dt>
                         <dd class="mt-1 text-sm text-gray-900">{{ $sale->transaction_id }}</dd>
                     </div>
                 </dl>
             </div>
         </div>
     </div>

 </div>
