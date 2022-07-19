<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void generateQrCode(string $transaction_no)
 * @method static void generateReceipt(Reservation $reservation)
 * @method static void deleteQrCodeAndReceipt(string $transaction_no)
 * 
 * @see \App\Services\Receipt
 */
class Receipt extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'receipt';
    }
}
