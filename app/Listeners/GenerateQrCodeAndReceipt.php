<?php

namespace App\Listeners;

use App\Events\ReservationCreated;
use App\Facades\Receipt;

class GenerateQrCodeAndReceipt
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ReservationCreated  $event
     * @return void
     */
    public function handle(ReservationCreated $event)
    {
        Receipt::generateQrCode($event->reservation->transaction_no);
        Receipt::generateReceipt($event->reservation);
    }
}
