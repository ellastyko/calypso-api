<?php

namespace App\Listeners;

use App\Events\ForgotPassword;
use App\Mail\PasswordResetEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetNotification implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    /**
     * Handle the event.
     *
     * @param  ForgotPassword  $event
     * @return void
     */
    public function handle(ForgotPassword $event)
    {
        $link = config('app.url') . '/password-reset?token=' . $event->token;

        Mail::to($event->user)->send(new PasswordResetEmail($event->user, $link));
    }
}
