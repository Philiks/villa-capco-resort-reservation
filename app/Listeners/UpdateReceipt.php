<?php

namespace App\Listeners;

use App\Events\ReservationUpdated;
use App\Facades\Receipt;

class UpdateReceipt
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ReservationUpdated  $event
     * @return void
     */
    public function handle(ReservationUpdated $event)
    {
        Receipt::generateReceipt($event->reservation);
    }
}
