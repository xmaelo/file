<?php

namespace App\Http\Controllers;

use App\Mail\BidAccepted;
use App\Mail\BidCancelled;
use App\Models\Bid;
use App\Models\BuyerInvoice;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use function Psy\debug;

class BidController extends Controller
{
    public function bid_accept()
    {
        $bid = Bid::find(request('bid_id'));
        $car = Car::find($bid->car_id);

        $car->update([
            'status' => 'sold',
            'max_bid' => $bid->bid_amount,
            'bidder_id' => $bid->bidder_id,
            'p_id' => $bid->bidder_id,
            'is_in_auction' => false
        ]);

        buyerInvoice($car, $car->bidder_id);
        singleSellerInvoice($car, $car->u_id);
        $buyer_invoice = BuyerInvoice::where('car_id', $car->id)->first();

        Log::info($buyer_invoice->invoice);
        $current_bidder_data = [
            'message' => 'Congratulations, your bid has been accepted.',
            'bidding_amount' => $car->max_bid,
            'service_charges' => publishPrice(),
            'total' => ($car->max_bid + publishPrice()),
            'brand' => $car->brand,
            'model' => $car->model,
            'invoice' => $buyer_invoice->invoice,
        ];

        $email = buyerInfo($car->bidder_id)->email;
        Mail::to($email)->send(new BidAccepted($current_bidder_data));


        return back()->with('bid_accepted', 'Bid accepted successfully.');
    }

    public function bid_cancel()
    {
        $bid = Bid::find(request('cancel_bid_id'));
        $car = Car::find($bid->car_id);
        $car_all_bids = Bid::where('car_id', $bid->car_id)->where('auction_id', currentAuction()->id)->get();

        $previous_bid_count = Bid::where('id', '<', $bid->id)->where('car_id', $bid->car_id)->where('auction_id', currentAuction()->id)->count();
        $previous_bid_id = Bid::where('id', '<', $bid->id)->where('car_id', $bid->car_id)->where('auction_id', currentAuction()->id)->max('id');
        $previous_bid = Bid::find($previous_bid_id);

        //dd($previous_bid);
        $email = sellerInfo($car->bidder_id)->email;

        if ($previous_bid_count == 0) {
            $car->update([
                'max_bid' => null,
                'bidder_id' => null,
                'p_id' => null
            ]);
        } else {
            $car->update([
                'max_bid' => $previous_bid->bid_amount,
                'bidder_id' => $previous_bid->bidder_id,
                'p_id' => $previous_bid->bidder_id,
                'is_in_auction' => false
            ]);
        }

        $current_bidder_data = [
            'message' => 'Your bid has been cancelled by the seller.',
            'brand' => $car->brand,
            'model' => $car->model,
        ];

        Mail::to($email)->send(new BidCancelled($current_bidder_data));

        $bid->delete();

        return back()->with('bid_canceled', 'Bid canceled successfully.');
    }

    public function user_bid_delete(Bid $bid)
    {
        //dd(request('bid_delete'));
        //$bid = Bid::find(request('bid_delete')); 
        //dd($bid->owner_id);       
        $bid->update([
            'status' => false,
        ]);
        return back()->with('user_bid', 'Bid deleted');
    }
}
