<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'membership_number',
        'ic_number',
        'full_name',
        'date_of_birth',
        'gender',
        'bangsa',
        'marital_status',
        'phone_number',
        'email',
        'address',
        'postcode',
        'city',
        'state',
        'occupation',
        'education_level',
        'notes',
        'is_active',
        'registered_date',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'registered_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get all households this member belongs to
     */
    public function households(): BelongsToMany
    {
        return $this->belongsToMany(Household::class, 'household_members')
            ->withPivot(['relationship', 'is_head'])
            ->withTimestamps();
    }

    /**
     * Get primary household
     */
    public function primaryHousehold()
    {
        return $this->households()->wherePivot('is_head', true)->first() 
            ?? $this->households()->first();
    }

    /**
     * Calculate age from date of birth
     */
    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    /**
     * Get full address formatted
     */
    public function getFullAddressAttribute(): ?string
    {
        if (!$this->address) {
            return null;
        }
        return "{$this->address}, {$this->postcode} {$this->city}, {$this->state}";
    }

    /**
     * Scope to get only active members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by gender
     */
    public function scopeGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    /**
     * Get formatted IC number (XXXXXX-XX-XXXX)
     */
    public function getFormattedIcAttribute(): string
    {
        $ic = $this->ic_number;
        return substr($ic, 0, 6) . '-' . substr($ic, 6, 2) . '-' . substr($ic, 8, 4);
    }
}