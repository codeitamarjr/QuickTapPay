<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLink extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentLinkFactory> */
    use HasFactory;

    protected $fillable = [
        'business_id',
        'payment_link_id',
        'title',
        'currency',
        'amount',
        'slug',
        'description',
        'user_id',
        'status',
        'payment_method',
        'currency',
    ];

    /**
     * Get the business that owns the payment link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * The user who created the payment link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the sales made through this payment link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Sale>
     */
    public function sales(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
