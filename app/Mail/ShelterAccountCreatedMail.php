<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShelterAccountCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');

        $mail = $this->subject('Your PawPal shelter account')
            ->markdown('emails.shelter.account_created')
            ->with([
                'user' => $this->user,
                'password' => $this->password,
            ]);

        if ($fromAddress) {
            $mail->from($fromAddress, $fromName);
        }

        return $mail;
    }
}
