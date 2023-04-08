<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private readonly object $user, private readonly string $link)
    {
    }

    /**
     * Build the message.
     *
     * @return VerificationEmail
     */
    public function build(): VerificationEmail
    {
        return $this->view('mails.verify_email')
            ->subject(trans('Email verification'))
            ->with([
                'user' => $this->user,
                'link' => $this->link
            ]);
    }
}
