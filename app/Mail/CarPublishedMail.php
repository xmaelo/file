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
    public $invoice_data; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($car, $invoice_data)
    {
       $this->car = $car;
       $this->invoice_data = $invoice_data;
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
        ])->attach(storage_path('app/public/pdf/' . $this->invoice_data['invoice']), [
            'as' => 'invoice.pdf',
            'mime' => 'application/pdf',
        ]);
    }
    
}
