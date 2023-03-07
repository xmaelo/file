<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SellerInvoice;
use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    public function index()
    {
        

        $today = Carbon::now()->toDateString();
        
        $arr = ['seller_invoices.*', 'users.email', "users.surname" , "users.first_name"];
        
        $no_paid_invoices = SellerInvoice::join('users', 'users.id', '=', 'seller_invoices.user_id')->whereDate('deadline', '>=',   $today)->where('paid', false)->get( $arr);
        
        $paid_invoices = SellerInvoice::join('users', 'users.id', '=', 'seller_invoices.user_id')->where('paid', true)->get( $arr);
        $late = SellerInvoice::join('users', 'users.id', '=', 'seller_invoices.user_id')->whereDate('deadline', '<',   $today)->where('paid', false)->get( $arr); 
        //$buyer_invoices = BuyerInvoice::all()->find();

        return view('admin.invoices.index', [
            'outstanding_invoices' => $no_paid_invoices,
            'paid_invoices' => $paid_invoices,
            'late_invoices' => $late
        ]);
    }


    public function mark_as_paid($invoice_id)
    {
        $today = Carbon::now()->toDateString();
        $invoice_id = request('invoice_id'); 
        if($invoice_id != null){
            // request()->validate([
            //     'invoice_id' => 'required',
            // ]);
            $invoice = SellerInvoice::find($invoice_id);
            $invoice->update([
                'paid' => true,
                'paid_date' => $today
            ]);
        }
         return redirect('/admin/invoices')->with('success', 'Updated successfully!');
    }
    
    
}
