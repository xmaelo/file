<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Car;
use App\Models\WishListItem;
use Illuminate\Http\Request;

class WishListItemController extends Controller
{
    public function index(){
        if (!session()->has('client_id')) {
            return redirect('/');
        }

        $auctions = Auction::where('isFinished', false)->where('status', false)->get();

        $sold = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'sold')->count();
        $purchased = Car::where('p_id', session()->get('client_id'))
            ->count();
        $current = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'Not sold')->count();

        $cars = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'Not sold')->get();
        $wishlist = WishListItem::where('user_id', session()->get('client_id'))
        ->get();

        return view('wishlist', [
            'cars' => $cars,
            'sold' => $sold,
            'purchased' => $purchased,
            'current' => $current,
            'auctions' => $auctions,
            'wishlist_items' => $wishlist,
        ]);
    }
    public function store(){
        request()->validate([
            'car_id' => 'required',
            'user_id' => 'required',
        ]);

        WishListItem::create([
            'car_id' => request('car_id'),
            'user_id' => request('user_id'),
        ]);
        return back()->with('wishlit_success','Added to wishlist');
    }
}
