<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all households in this zone
     */
    public function households(): HasMany
    {
        return $this->hasMany(Household::class);
    }

    /**
     * Get all members through households
     */
    public function members()
    {
        return $this->hasManyThrough(
            Member::class,
            Household::class,
            'zone_id',
            'id',
            'id',
            'id'
        )->join('household_members', 'members.id', '=', 'household_members.member_id')
         ->where('household_members.household_id', '=', DB::raw('households.id'));
    }

    /**
     * Scope to get only active zones
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}