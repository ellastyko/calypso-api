<?php

namespace App\Listeners;

use App\Events\ForgotPassword;
use App\Mail\PasswordResetEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  ForgotPassword  $event
     * @return void
     */
    public function handle(ForgotPassword $event)
    {
        Mail::to($event->user)->send(new PasswordResetEmail($event->user, $event->link));
    }
}
