<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address_line1',
        'address_line2',
        'address_line3',
        'address_line4',
        'postal_code',
        'city',
        'country',
        'website',
        'logo',
        'vat_number',
        'tax_number',
        'currency',
    ];

    /**
     * Get the users that belong to the Business
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    /**
     * Get the payment links for the Business
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paymentLinks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PaymentLink::class);
    }
}
