<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class BuyerInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice_data)
    {
        $this->invoice_data = $invoice_data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.buyer-invoice-mail')->with([
            'data' => $this->invoice_data
        ])->attach('storage/pdf/' . $this->invoice_data['invoice'], [
            'as' => 'invoice.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
