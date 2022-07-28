<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'max_people',
        'start_time',
        'end_time',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime:h:i A',
        'end_time' => 'datetime:h:i A',
    ];

    /**
     * Accommodations that belong to the Package.
     */
    public function accommodations(): BelongsToMany
    {
        return $this->belongsToMany(Accommodation::class)
            ->withTimestamps()
            ->withPivot(['rate', 'max_people']);
    }

    /**
     * Get the Reservations for the Package.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
