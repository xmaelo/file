<?php

namespace App\Http\Controllers;

use App\Mail\CarApproval;
use App\Mail\CurrentBidder;
use App\Mail\OutBidMail;
use App\Mail\SellerMail;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Car;
use App\Models\CarAuctionCount;
use App\Models\TempDocument;
use App\Models\TempFile;
use App\Models\User;
use App\Models\WishListItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }
        $cars = Car::all();
        return view('admin.cars.index', [
            'data' => $cars
        ]);
    }
    public function show(Car $car)
    {
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }
        return view('admin.cars.edit', [
            'car' => $car
        ]);
    }

    public function current_vehicles()
    {
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
        return view('current-vehicles', [
            'cars' => $cars,
            'sold' => $sold,
            'purchased' => $purchased,
            'current' => $current,
            'auctions' => $auctions,
            'wishlist' => $wishlist,
        ]);
    }

    public function current_vehicle($slug)
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $data = Car::where('slug', $slug)->first();
        $bidder = User::find($data->bidder_id);

        $image =  getBadge($data->u_id);
        $url = Storage::url("public/images/memberships/$image");

        $isAuctionActive = isAuctionActive();

        $nextAuction = Auction::where('isFinished', false)->min('start_date');
        $currentAuctionEnd = Auction::where('isFinished', '=', false)->where('status', true)->value('end_date');
        $nextAuction = json_encode($nextAuction);
        $currentAuctionEnd = json_encode($currentAuctionEnd);

        $car = Car::where('slug', $slug)->first();
        return view('current-single-vehicle', [
            'car' => $car,
            'bidder' => $bidder,
            'nextAuction' => $nextAuction,
            'currentAuctionEnd' => $currentAuctionEnd,
            'isAuctionActive' => $isAuctionActive,
            'badge' => $url,
            'image' => $image
        ]);
    }
    public function current_vehicle_edit($slug)
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $auctions = Auction::where('isFinished', false)->where('status', false)->get();

        $car = Car::where('slug', $slug)->first();
        return view('current-edit', [
            'car' => $car,
            'auctions' => $auctions
        ]);
    }

    public function current_vehicle_update($slug)
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $car = Car::where('slug', $slug)->first();
        $date = new Carbon(request('first_registration'));
        $year = (int) $date->year;

        $car->update([
            'brand' => request('brand'),
            'model' => request('model'),
            'type' => request('type'),
            'body_type' => request('body_type'),
            'doors' => request('doors'),
            'first_registration' => request('first_registration'),
            'reg_year' => $year,
            'milage' => request('milage'),
            'exterior_color' => request('exterior_color'),
            'exterior_finish' => request('exterior_finish'),
            'interior_color' => request('interior_color'),
            'interior_finish' => request('interior_finish'),
            'special_equipments' => request('special_equipments'),
            'serial_equipments' => request('serial_equipments'),
            'wheel_drive' => request('wheel_drive'),
            'gear' => request('gear'),
            'fuel' => request('fuel'),
            'displacement' => request('displacement'),
            'performance_hp' => request('performance_hp'),
            'performance_kw' => request('performance_kw'),
            'seats' => request('seats'),
            'frame_number' => request('frame_number'),
            'model_number' => request('model_number'),
            'vehicle_number' => request('vehicle_number'),
            'register_number' => request('register_number'),
            'direct_import' => request('direct_import'),
            'additional_info' => request('additional_info'),
            'factory_price' => request('factory_price'),
            'general_conditions' => request('general_conditions'),
            'registration_document' => request('registration_document'),
            'service_record_booklet' => request('service_record_booklet'),
            'inspection' => request('inspection'),
            'repairs' => request('repairs'),
            'service_record_digital' => request('service_record_digital'),
            'keys' => request('keys'),
            'mechanics' => request('mechanics'),
            'body' => request('body'),
            'car_finish' => request('car_finish'),
            'others' => request('others'),
            'min_price' => request('min_price'),
            'location' => request('location'),
            'status' => "Not sold",
        ]);
        $tempFile = TempFile::where('u_id', session()->get('client_id'))->get();
        $images = [];
        if ($tempFile->count() > 0) {
            foreach ($tempFile as $t) {
                $images[] = $t->folder . '/' . $t->filename;
                Storage::move(
                    'public/images/cars/tmp/' . $t->folder,
                    'public/images/cars/' . $t->folder
                );
                $t->delete();
            }
            $car->update([
                "images"  =>  $images
            ]);
        }


        $tempDocs = TempDocument::where('u_id', session()->get('client_id'))->get();
        $documents = [];
        if ($tempDocs->count() > 0) {
            foreach ($tempDocs as $t) {
                $documents[] = $t->folder . '/' . $t->filename;
                Storage::move(
                    'public/documents/cars/tmp/' . $t->folder,
                    'public/documents/cars/' . $t->folder
                );
                $t->delete();
            }
            $car->update([
                "documents"  =>  $documents
            ]);
        }

        return back()->with('car_updated', 'Updated successfully');
    }


    public function sold_vehicles()
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $sold = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'sold')
            ->count();
        $purchased = Car::where('p_id', session()->get('client_id'))
            ->count();
        $current = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'Not sold')->count();
        $wishlist = WishListItem::where('user_id', session()->get('client_id'))
        ->get();

        $cars = Car::where('u_id', session()->get('client_id'))->where('status', 'sold')->get();
        return view('sold-vehicles', [
            'cars' => $cars,
            'sold' => $sold,
            'purchased' => $purchased,
            'current' => $current,
            'wishlist' => $wishlist,
        ]);
    }
    public function sold_vehicle_show($slug)
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }

        $car = Car::where('slug', $slug)->first();
        $bidder = User::find($car->bidder_id);

        $isAuctionActive = isAuctionActive();

        $image =  getBadge($car->u_id);
        $url = Storage::url("public/images/memberships/$image");
        $nextAuction = Auction::where('isFinished', false)->min('start_date');
        $currentAuctionEnd = Auction::where('isFinished', '=', false)->where('status', true)->value('end_date');
        $nextAuction = json_encode($nextAuction);
        $currentAuctionEnd = json_encode($currentAuctionEnd);


        return view('sold-single-vehicle', [
            'car' => $car,
            'bidder' => $bidder,
            'nextAuction' => $nextAuction,
            'currentAuctionEnd' => $currentAuctionEnd,
            'isAuctionActive' => $isAuctionActive,
            'badge' => $url,
            'image' => $image
        ]);
    }
    public function purchased_vehicles()
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $sold = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'sold')
            ->count();
        $purchased = Car::where('p_id', session()->get('client_id'))
            ->count();
        $current = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'Not sold')->count();

        $cars = Car::where('p_id', session()->get('client_id'))->get();
        $wishlist = WishListItem::where('user_id', session()->get('client_id'))
            ->get();
        return view('purchased-vehicles', [
            'cars' => $cars,
            'sold' => $sold,
            'purchased' => $purchased,
            'current' => $current,
            'wishlist' => $wishlist,
        ]);
    }
    public function purchased_vehicle_show($slug)
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $car = Car::where('slug', $slug)->first();
        $bidder = User::find($car->bidder_id);
        $isAuctionActive = isAuctionActive();

        $image =  getBadge($car->u_id);
        $url = Storage::url("public/images/memberships/$image");

        return view('purchased-single-vehicle', [
            'car' => $car,
            'bidder' => $bidder,
            'isAuctionActive' => $isAuctionActive,
            'badge' => $url,
            'image' => $image,

        ]);
    }

    public function customer_bid()
    {
        if (!session()->has('client_id')) {
            return back();
        }

        $car = Car::find(request('car-id'));

        if ($car->max_bid == request('current-bid')) {
            return back()->with('bid_taken', 'Amount you tried to bid is already taken');
        }

        if ($car->max_bid && $car->max_bid > request('current-bid')) {
            return back()->with('low_bid', 'Amount you tried to bid is lower than current bid.');
        }
        if (!isAuctionActive()) {
            return back()->with('auction_over', 'Auction is over.');
        }


        $bidder = buyerInfo(session()->get('client_id'));

        $currentAuction = Auction::where('status', true)->first();
        $previous_bid = Bid::where('car_id', $car->id)->where('auction_id', currentAuction()->id)->latest()->first();

        if ($previous_bid) {
            if (session()->get('client_id') ==  $previous_bid->bidder_id) {
                return back()->with('highest_bidder', 'You are already the highest bidder!');
            }
        }

        //dd($previous_bid);
        Bid::create([
            'car_id' => $car->id,
            'bidder_id' => session()->get('client_id'),
            'auction_id' => $currentAuction->id,
            'bid_amount' => request('current-bid'),
            'owner_id' => $car->u_id,
        ]);

        // if ($car->max_bid == null) {
        //     if ($car->min_price < request('current-bid')) {
        //         $car->update([
        //             "bidder_id" => request('bidder-id'),
        //             "max_bid" => request('current-bid'),
        //         ]);
        //         return back();
        //     }
        // } else {
        //     if ($car->max_bid < request('current-bid')) {
        //         $car->update([
        //             "bidder_id" => request('bidder-id'),
        //             "max_bid" => request('current-bid'),
        //         ]);
        //         return back();
        //     }
        // }

        $car_bids_count = Bid::where('car_id', $car->id)->where('auction_id', currentAuction()->id)->count();

        $car->update([
            "bidder_id" => request('bidder-id'),
            "max_bid" => request('current-bid'),
        ]);
        //dd(request('bidder-id'));

        $current_bidder_data = [
            'message' => 'Congratulations, you are the highest bidder.',
            'bidding_amount' => $car->max_bid,
            'service_charges' => publishPrice(),
            'total' => ($car->max_bid + publishPrice()),
            'brand' => $car->brand,
            'model' => $car->model,
        ];

        $out_bidder_data = [
            'message' => 'You have been out bidded.',
            'brand' => $car->brand,
            'model' => $car->model,
        ];

        $seller = [
            'message' => 'your car has a new bid',
            'bidding_amount' => $car->max_bid,
            'brand' => $car->brand,
            'model' => $car->model,
        ];

        if ($car_bids_count == 1) {
            Mail::to(buyerInfo(session()->get('client_id'))->email)->send(new CurrentBidder($current_bidder_data));
            Mail::to(sellerInfo($car->u_id)->email)->send(new SellerMail($seller));
        } else {
            //dd('else');
            Mail::to(buyerInfo(session()->get('client_id'))->email)->send(new CurrentBidder($current_bidder_data));
            Mail::to(buyerInfo($previous_bid->bidder_id)->email)->send(new OutBidMail($out_bidder_data));
            Mail::to(sellerInfo($car->u_id)->email)->send(new SellerMail($seller));
        }


        return back();
    }
    public function destroy(Car $car)
    {
        $car->delete();
        return back();
    }

    public function sold_cars()
    {
        $sold_cars = Car::where('status', 'sold')->orderBy('updated_at', 'desc')->get();
        return view('admin.sold_cars.index', compact('sold_cars'));
    }
    public function search()
    {
        $ref_number = request('ref_number') ?? '';
        $cars = Car::where('ref_number', 'like', '%' . $ref_number . '%')
            ->get();
        return view('admin.search.index', compact('cars'));
    }
    public function dashboard()
    {
        checkAuctionsEnded();

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
        $bids = Bid::where('auction_id', currentAuction()->id ?? 0)->where('owner_id', session()->get('client_id'))->get();
        
        $current_user_bids = Bid::where('bidder_id', session()->get('client_id'))->get();
        return view('dashboard', compact('bids', 'sold', 'purchased', 'current', 'wishlist','current_user_bids'));
    }

    public function current_vehicle_auction($id)
    {
        $car = Car::find($id);
        request()->validate([
            'auction' => 'required'
        ]);

       CarAuctionCount::create([
            'auction' => request('auction'),
            'car_id' => $car->id,
        ]);

        if (!isAuctionActive()) {
            $car->update([
                'auction' => request('auction')
            ]);
            return back()->with('auction_updated', 'Auction updated successfully');
        }
        return back()->with('fail_update', 'Can not update auction while auction is active.');
    }
}
