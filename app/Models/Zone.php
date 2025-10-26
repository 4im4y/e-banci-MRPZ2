<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Scope to get only active zones
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
