<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The Reservation transaction_no.
     * 
     * @var string
     */
    public $transaction_no;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $transaction_no)
    {
        $this->transaction_no = $transaction_no;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
