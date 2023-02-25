<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CarApproval extends Mailable
{
    use Queueable, SerializesModels;
    public $car_info; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($car_info)
    {
        $this->car_info = $car_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.cars.car_approval');
    }
}
