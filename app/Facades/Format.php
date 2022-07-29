<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static float moneyForDisplay(int $moneyFromDatabase)
 * @method static int moneyForDatabase(float $money)
 * @method static string stringTimeForDisplay(string $time)
 * @method static string stringTimeForDatabase(string $time)
 * 
 * @see \App\Services\Format
 */
class Format extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'format';
    }
}
