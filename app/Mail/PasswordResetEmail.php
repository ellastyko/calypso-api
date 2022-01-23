<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetEmail extends Mailable
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
     * @return $this
     */
    public function build(): static
    {
        return $this->view('mails.reset_password')
                        ->subject(trans('passwords.forgot.subject'))
                        ->with([
                            'user' => $this->user,
                            'link' => $this->link
                        ]);
    }
}
