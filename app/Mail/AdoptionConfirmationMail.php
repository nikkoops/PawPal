<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdoptionConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adopterData;

    public function __construct($adopterData)
    {
        $this->adopterData = $adopterData;
    }

    public function build()
    {
        return $this->subject('PawPal Adoption Confirmation')
                    ->view('emails.adoption_confirmation');
    }
}
