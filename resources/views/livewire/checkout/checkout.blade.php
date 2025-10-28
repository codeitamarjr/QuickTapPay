 <div>
     <x-slot name="logo">
        @if ($link->business->logo_url)
            <img src="{{ $link->business->logo_url }}" alt="{{ $link->business->name }}"
                class="h-8 w-auto" />
        @endif
     </x-slot>

     <x-slot name="title">{{ $link->business->name ?? 'Checkout' }}</x-slot>

     <x-slot name="description">
         {{ __('Secure payment for :service', ['service' => $link->title]) }}
     </x-slot>

     {{-- Checkout form starts here --}}
     <div class="bg-gray-50">
         <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
             <form wire:submit.prevent="submit" class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
                 <div>
                     <div>
                         <h2 class="text-lg font-medium text-gray-900">Contact Information</h2>

                         <div class="mt-4">
                             <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                             <div class="mt-2">
                                 <input type="text" id="name" wire:model.defer="name" autocomplete="name"
                                     class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm"
                                     required>
                                 @error('name')
                                     <span class="text-sm text-red-600">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>


                         <div class="mt-4">
                             <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                             <div class="mt-2">
                                 <input type="email" id="email" wire:model.defer="email" autocomplete="email"
                                     class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm"
                                     required>
                                 @error('email')
                                     <span class="text-sm text-red-600">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="mt-4">
                             <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                             <div class="mt-2">
                                 <input type="text" id="phone" wire:model.defer="phone" autocomplete="tel"
                                     class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm"
                                     required>
                                 @error('phone')
                                     <span class="text-sm text-red-600">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="mt-4">
                             <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                             <div class="mt-2">
                                 <input type="text" id="reference" wire:model.defer="reference"
                                     class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm"
                                     required>
                                 @error('reference')
                                     <span class="text-sm text-red-600">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                     </div>
                 </div>

                 <!-- Order summary -->
                 <div class="mt-10 lg:mt-0">
                     <h2 class="text-lg font-medium text-gray-900">Order Summary</h2>

                     <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                         <ul role="list" class="divide-y divide-gray-200">
                             <li class="flex px-4 py-6 sm:px-6">
                                 <div class="ml-6 flex flex-1 flex-col">
                                     <div class="flex">
                                         <div class="min-w-0 flex-1">
                                             <h4 class="text-sm font-medium text-gray-700">{{ $link->title }}</h4>
                                             <p class="mt-1 text-sm text-gray-500">{{ $link->description }}</p>
                                         </div>
                                     </div>
                                     <div class="flex items-end justify-between pt-2">
                                         <p class="text-sm font-medium text-gray-900">
                                             {{ Number::currency($link->amount, $link->business->currency) }}
                                         </p>
                                     </div>
                                 </div>
                             </li>
                         </ul>

                         <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
                             <div class="flex items-center justify-between">
                                 <dt class="text-base font-medium">Total</dt>
                                 <dd class="text-base font-medium text-gray-900">
                                     {{ Number::currency($link->amount, $link->business->currency) }}
                                 </dd>
                             </div>
                         </dl>

                         <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                             <button type="submit" wire:loading.attr="disabled"
                                 class="w-full rounded-md bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                                 Confirm and Pay
                             </button>
                             <span class="text-xs text-gray-500">By clicking "Confirm and Pay", you agree to the
                                 <a href="{{ route('terms.of.service') }}" class="font-medium text-indigo-600 hover:text-indigo-500" _target="_blank">Terms and
                                     Conditions</a>,
                                 and acknowledge that you have read and understand our <a href="{{ route('privacy.policy') }}"
                                     class="font-medium text-indigo-600 hover:text-indigo-500" _target="_blank">Privacy Policy</a> and <a href="{{ route('vendor.disclaimer') }}"
                                     class="font-medium text-indigo-600 hover:text-indigo-500" _target="_blank">Vendor Disclaimer</a>.
                             </span>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
