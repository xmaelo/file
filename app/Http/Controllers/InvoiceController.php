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
        $no_paid_invoices = SellerInvoice::whereDate('deadline', '>=',   $today)->where('paid', false)->get();
        $paid_invoices = SellerInvoice::where('paid', true)->get();
        $late = SellerInvoice::whereDate('deadline', '<',   $today)->where('paid', false)->get();
        //$buyer_invoices = BuyerInvoice::all()->find();

        return view('admin.invoices.index', [
            'outstanding_invoices' => $no_paid_invoices,
            'paid_invoices' => $paid_invoices,
            'late_invoices' => $late
        ]);
    }
    
    public function update(Price $price)
    {
        // request()->validate([
        //     'price' => 'required'
        // ]);
        // $price->update([
        //     'price' => request('price')
        // ]);
        return back()->with('price_updated', 'Price updated successfully.');
    }
}
