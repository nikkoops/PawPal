<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdopterConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $answers;

    public function __construct($name, $answers = [])
    {
        $this->name = $name;
        $this->answers = $answers;
    }

    public function build()
    {
        // ensure there's an explicit from address to avoid mail transport rejections
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');

        $mail = $this->subject('Thank You for Your Adoption Request!')
                     ->markdown('emails.adopter.confirmation')
                     ->with([
                         'name' => $this->name,
                         'answers' => $this->answers,
                     ]);

        if ($fromAddress) {
            $mail->from($fromAddress, $fromName ?: null);
        }

        return $mail;
    }
}
