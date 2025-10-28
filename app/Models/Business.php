<?php

namespace App\Models;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

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
     * Attachments stored for the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * The attachment representing the business logo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function logoAttachment(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachable')
            ->where('collection', 'logo');
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

        if ($legacyPath) {
            return Storage::disk('public')->url($legacyPath);
        }

        return null;
    }
}
