<section class="w-full">
    {{-- Page Heading --}}
    @include('partials.business-heading')

    {{-- Main Layout Wrapper --}}
    <x-business.layout :heading="__('Create Business')" :subheading="__('Set up your business information to start collecting payments.')">
        @include('livewire.business.partials.create-form')
    </x-business.layout>
</section>
