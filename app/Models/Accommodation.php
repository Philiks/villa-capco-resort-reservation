<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'details',
    ];

    /**
     * Get the Images for the Accommodation.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Packages that belong to the Accommodation.
     */
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class)
            ->withTimestamps()
            ->withPivot(['rate', 'max_people']);
    }

    /**
     * Get the Reservations for the Accommodation.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
