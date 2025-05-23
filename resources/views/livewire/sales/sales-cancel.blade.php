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

     <div class="mt-8 bg-gray-50 flex items-center justify-center px-4">
         <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8 text-center">
             <div class="mx-auto mb-4">
                 <svg class="mx-auto h-16 w-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                 </svg>
             </div>

             <h2 class="text-2xl font-semibold text-gray-900">Payment Cancelled</h2>
             <p class="mt-2 text-gray-600">Your payment was not completed. You can try again anytime.</p>


             <a href="{{ route('checkout.show', ['paymentLink' => $link->slug]) }}"
                 class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-md transition">
                 Return Service Page
             </a>
         </div>
     </div>

 </div>
