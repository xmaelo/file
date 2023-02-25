<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CarPublishedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $car;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($car)
    {
       $this->car = $car;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.car_published_mail')->with([
            'car' => $this->car
        ]);
    }
}
