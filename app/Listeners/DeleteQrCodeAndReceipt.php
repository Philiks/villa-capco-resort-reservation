<?php

namespace App\Listeners;

use App\Events\ReservationDeleted;
use App\Facades\Receipt;

class DeleteQrCodeAndReceipt
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ReservationDeleted  $event
     * @return void
     */
    public function handle(ReservationDeleted $event)
    {
        Receipt::deleteQrCodeAndReceipt($event->transaction_no);
    }
}
