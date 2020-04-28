<?php

namespace App\Listeners;

use App\Events\DueBookingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NotifyDoctorOnBooking;
class NotifyUsersOnBooking
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DueBookingEvent  $event
     * @return void
     */
    public function handle(DueBookingEvent $event)
    {
        //
        foreach ($event->dueBooking as $booking) {
            $booking->doctor->notify(new NotifyDoctorOnBooking($booking));
            # code...
        }
    }
}
