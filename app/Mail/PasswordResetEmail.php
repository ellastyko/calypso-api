<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class PasswordResetEmail
 */
class PasswordResetEmail extends Mailable // implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private object $user, private string $link)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): PasswordResetEmail
    {
        return $this->view('mails.reset_password')
                        ->subject(trans('passwords.forgot.subject'))
                        ->with([
                            'user' => $this->user,
                            'link' => $this->link
                        ]);
    }
}
