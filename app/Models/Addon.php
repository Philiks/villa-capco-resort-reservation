<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Addon extends Model
{
    use HasFactory;

    /**
     * This Addon is for all of the packages.
     */
    public const ADDON_FOR_ALL_PACKAGES = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'rate',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rate' => 'integer',
    ];

    /**
     * Get the Package that owns the Addon.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Reservations that belong to the Addon.
     */
    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class)
            ->withTimestamps()
            ->withPivot(['quantity']);
    }
}
