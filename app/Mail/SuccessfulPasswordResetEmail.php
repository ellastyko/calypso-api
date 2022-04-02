<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SuccessfulPasswordResetEmail
 */
class SuccessfulPasswordResetEmail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     * @param $user
     */
    public function __construct(private $user)
    {
    }

    /**
     * Build the message.
     *
     * @return SuccessfulPasswordResetEmail
     */
    public function build(): SuccessfulPasswordResetEmail
    {
        return $this->view('mails.successful_password_reset')
            ->subject(trans('Your password was reset'))
            ->with([
                'user' => $this->user,
            ]);
    }
}
