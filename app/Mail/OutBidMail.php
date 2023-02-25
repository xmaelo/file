<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OutBidMail extends Mailable
{
    use Queueable, SerializesModels;
    public $out_bidder_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($out_bidder_data)
    {
        $this->out_bidder_data =$out_bidder_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.out_bidder')->with([
            'data' => $this->out_bidder_data
        ]);
    }
}
