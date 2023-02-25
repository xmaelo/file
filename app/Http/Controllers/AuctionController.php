<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class AuctionController extends Controller
{
    public function index()
    {
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }

        $auctions = Auction::all();
        $dates = array();
        foreach ($auctions as $a) {
            $dates[] = [
                "from" => $a->start_date,
                "to" => $a->end_date,
            ];
        }
        $array = json_encode($dates);

        return view('admin.auction.index', [
            'auctions' => $auctions,
            'auction_dates' => $array
        ]);
    }

    public function store()
    {
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }
        request()->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $isDateAvailable = Auction::whereBetween('start_date', array(request('start_date'), request('end_date')))
            ->orWhereBetween('end_date', array(request('start_date'), request('end_date')))
            ->get();

        if ($isDateAvailable->count() == 0) {
            Auction::create([
                'start_date' => request('start_date'),
                'end_date' => request('end_date'),
            ]);
        } else {
            return back()->with('err', 'Date is not available');
        }
        return back();
    }

    public function destroy(Auction $auction)
    {
        $auction->delete();
        return back();
    }
}
