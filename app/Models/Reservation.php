<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_of_people',
        'amount_to_pay',
        'reserved_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'no_of_people' => 'integer',
        'amount_to_pay' => 'integer',
        'reserved_date' => 'date',
    ];

    /**
     * Addons that belong to the Reservation.
     */
    public function addons(): BelongsToMany
    {
        return $this->belongsToMany(Addon::class);
    }

    /**
     * Get the Package that owns the Reservation.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    // TODO: add user_id to identify which user (nullable) booked for reservation.
}
