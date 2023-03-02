<?php

namespace App\Mail;
use Illuminate\Bus\Queueable; 
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SellerInvoice;

class InvoiceExpired extends Mailable
{
    use Queueable, SerializesModels;
    public $late_invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($late_invoice)
    {
        $this->late_invoice = $late_invoice;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	
        $this->subject('OBJET : Relance d’impayé - facture n°'.$this->late_invoice->ref_number)->markdown('admin.invoices.email')->with([
            'data' =>  $this->late_invoice
        ])->attach(storage_path('app/public/pdf/' . $this->late_invoice->invoice), [
            'as' => 'invoice.pdf',
            'mime' => 'application/pdf',
        ]);

        $late_invoice2 = SellerInvoice::find($this->late_invoice->id);
        return $late_invoice2->update([
            'email_send_counter' => $this->late_invoice->email_send_counter + 1
        ]);
    }
}
