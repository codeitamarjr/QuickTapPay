@component('mail::message')
# Payment {{ ucfirst($type) }}

Hi {{ $sale->name }},

Here are the details of your {{ $type }} transaction:

@component('mail::panel')
**Business**: {{ $sale->paymentLink->business->name }}  
**Service**: {{ $sale->paymentLink->title }}  
**Amount**: {{ Number::currency($sale->amount, $sale->currency) }}  
**Status**: {{ ucfirst($sale->status) }}  
**Reference**: {{ $sale->reference ?? '-' }}  
**Transaction ID**: {{ $sale->transaction_id }}
@endcomponent

If you have any questions, feel free to contact us.

Thanks,  
{{ config('app.name') }} — on behalf of {{ $sale->paymentLink->business->name }}
If you have questions, you can reach them at:
{{ $sale->paymentLink->business->email }}
{{ $sale->paymentLink->business->phone }}
@endcomponent
