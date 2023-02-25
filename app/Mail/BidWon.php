<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BidWon extends Mailable
{
    use Queueable, SerializesModels;
    public $current_bidder_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($current_bidder_data)
    {
        $this->current_bidder_data =$current_bidder_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.bidwon')->with([
            'data' => $this->current_bidder_data
        ]);
    }
}
