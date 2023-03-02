<?php

namespace App\Console\Commands;

use App\Models\SellerInvoice;
use Illuminate\Console\Command;
use Mail;
use Carbon\Carbon;
use App\Mail\InvoiceExpired;

class StartJob extends Command
{ 
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = Carbon::now()->toDateString();
        $late_invoices = SellerInvoice::join('users', 'users.id', '=', 'seller_invoices.user_id')->whereDate('seller_invoices.deadline', '<=',   $today)->where('seller_invoices.paid', false) ->where('seller_invoices.email_send_counter', '<', 4)->get(['seller_invoices.*', 'users.email', "users.form_of_address" , "users.first_name"]);

        if ($late_invoices->count() > 0) {
            foreach ($late_invoices as $late_invoice) {
                
                Mail::to($late_invoice->email)->send(new InvoiceExpired($late_invoice));
            }
        }
        
       var_dump("Cron Job running at 22 ". now());

    }
}