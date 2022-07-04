<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Addon extends Model
{
    use HasFactory;

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
     * Reservations that belong to the Addon.
     */
    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class)
            ->withTimestamps()
            ->withPivot(['quantity']);
    }
}
