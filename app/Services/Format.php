<?php

namespace App\Services;

class Format
{
    /**
     * Determines if the number of decimal places to conveert.
     * i.e. 2 decimal places will convert 10000 to 100.00 before displaying
     * and 100.00 to 10000 before saving to database.
     */
    const DECIMAL_PLACES = 2;

    /**
     * The factor based on the DECIMAL_PLACES. Since the money is in base-10,
     * the base of the exponential expression is 10.
     */
    const FACTOR = 10 ** self::DECIMAL_PLACES;

    public function moneyForDisplay(int $moneyFromDatabase): float
    {
        return $moneyFromDatabase / self::FACTOR;
    }

    public function moneyForDatabase(float $money): int
    {
        return $money * self::FACTOR;
    }

    public function stringTimeForDisplay(string $time): string
    {
        $dateTime = date_create($time);
        return date_format($dateTime, 'h:i A');
    }

    public function stringTimeForDatabase(string $time): string
    {
        $dateTime = date_create($time);
        return date_format($dateTime, 'H:i:s');
    }
}