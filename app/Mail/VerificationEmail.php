<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{

    use Queueable, SerializesModels;

    private object $user;

    private string $link;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $user, string $link)
    {
        $this->user = $user;
        $this->link = $link;
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
