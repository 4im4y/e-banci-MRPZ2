<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_number',
        'zone_id',
        'address',
        'postcode',
        'city',
        'state',
        'monthly_income',
        'income_range',
        'notes',
    ];

    protected $casts = [
        'monthly_income' => 'decimal:2',
    ];

    /**
     * Get the zone that owns the household
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * Get all members in this household
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'household_members')
            ->withPivot(['relationship', 'is_head'])
            ->withTimestamps();
    }

    /**
     * Get the head of household
     */
    public function head()
    {
        return $this->members()->wherePivot('is_head', true)->first();
    }

    /**
     * Get full address formatted
     */
    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->postcode} {$this->city}, {$this->state}";
    }

    /**
     * Get total members in household
     */
    public function getTotalMembersAttribute(): int
    {
        return $this->members()->count();
    }
}
