<?php

namespace App\Listeners;

use App\Mail\VerificationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(object $event)
    {
        Mail::to($event->user)->send(new VerificationEmail($event->user, $event->link));
    }
}
