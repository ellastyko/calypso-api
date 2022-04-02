<?php

namespace App\Listeners;

use App\Mail\VerificationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationNotification implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

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
