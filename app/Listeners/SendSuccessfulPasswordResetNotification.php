<?php

namespace App\Listeners;

use App\Mail\SuccessfulPasswordResetEmail;
use Illuminate\Support\Facades\Mail;

class SendSuccessfulPasswordResetNotification
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(object $event)
    {
         Mail::to($event->user)->send(new SuccessfulPasswordResetEmail($event->user));
    }
}
