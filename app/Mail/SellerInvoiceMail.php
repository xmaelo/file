<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SellerInvoiceMail extends Mailable
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
        //$path = storage_path();
        return $this->markdown('emails.seller-invoice-mail')->with([
            'data' => $this->invoice_data
        ])->attach(storage_path('app/public/pdf/' . $this->invoice_data['invoice']), [
            'as' => 'invoice.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
