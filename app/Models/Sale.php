<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $fillable = [
        'business_id',
        'payment_link_id',
        'amount',
        'currency',

        'name',
        'email',
        'phone',
        'reference',

        'status',
        'transaction_id',
        'payment_method',
        'stripe_session_id',
        'stripe_payment_intent_id',
    ];

    /**
     * Get the payment link associated with the sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\PaymentLink>
     */
    public function paymentLink(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentLink::class);
    }
}
