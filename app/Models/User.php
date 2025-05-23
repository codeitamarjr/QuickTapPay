<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_account_id',
        'stripe_ready',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * The businesses that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Business>
     */
    public function businesses(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Business::class)->withPivot('role')->withTimestamps();
    }

    /**
     * Get the user's role in a specific business
     *
     * @param \App\Models\Business $business
     * @return string|null
     */
    public function roleInBusiness(Business $business): ?string
    {
        return $this->businesses()->where('business_id', $business->id)->first()?->pivot?->role;
    }
    /**
     * Check if the user is an admin in a specific business
     *
     * @param \App\Models\Business $business
     * @return bool
     */
    public function isAdmin(Business $business): bool
    {
        return $this->roleInBusiness($business) === 'admin';
    }
}
