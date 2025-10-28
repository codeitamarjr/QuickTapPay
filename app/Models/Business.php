<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
use QuickTapPay\Attachments\Traits\HasAttachments;

class Business extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessFactory> */
    use HasFactory;
    use HasAttachments;

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

    protected $appends = [
        'logo_url',
    ];

    protected $with = [
        'logoAttachment',
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

    /**
     * The attachment representing the business logo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function logoAttachment(): MorphOne
    {
        return $this->attachment('logo');
    }

    /**
     * Resolve a public URL for the business logo (if one exists).
     */
    public function getLogoUrlAttribute(): ?string
    {
        if (! $this->getKey()) {
            $legacyPath = $this->attributes['logo'] ?? null;

            return $legacyPath ? Storage::disk('public')->url($legacyPath) : null;
        }

        $attachment = $this->relationLoaded('logoAttachment')
            ? $this->getRelation('logoAttachment')
            : $this->logoAttachment()->first();

        if ($attachment) {
            return $attachment->url();
        }

        $legacyPath = $this->attributes['logo'] ?? null;

        return $legacyPath ? Storage::disk('public')->url($legacyPath) : null;
    }
}
