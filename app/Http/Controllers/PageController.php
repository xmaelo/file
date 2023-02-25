<?php

namespace App\Http\Controllers;

use App\Mail\BidWon;
use App\Models\Auction;
use App\Models\Car;
use App\Models\Client;
use App\Models\Membership;
use App\Models\SellerInvoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
   public function index(Request $req)
   {
      //session()->flush();
      $brand = request('brand');
      $fuel = request('fuel');
      $gear = request('gear');
      $wheel_drive = request('wheel_drive');
      $year_from = request('year_from');
      $year_to = request('year_to');
      $milage_from = request('milage_from');
      $milage_to = request('milage_to');
      $price_from = request('price_from');
      $price_to = request('price_to');
      //$sort = request('sort');
      $today = date('Y');
      $max_milage = Car::max('milage');
      $max_price = Car::max('min_price');


      if (!empty($req->input('year_from'))) {

         $year_from = $req->input('year_from');
      } else {
         $year_from =  -1;
      }
      if (!empty($req->input('year_to'))) {
         $year_to = $req->get('year_to');
      } else {
         $year_to = (int)$today + 1;
      }

      if (!empty($req->input('milage_from'))) {
         $milage_from = $req->get('milage_from');
      } else {
         $milage_from =  -1;
      }

      if (!empty($req->input('milage_to'))) {
         $milage_to = $req->get('milage_to');
      } else {
         $milage_to = $max_milage + 1;
      }

      if (!empty($req->input('price_from'))) {
         $price_from = $req->get('price_from');
      } else {
         $price_from =  -1;
      }

      if (!empty($req->input('price_to'))) {

         $price_to = $req->get('price_to');
      } else {
         $price_to = $max_price + 1;
      }

      $nextAuction = Auction::where('isFinished', false)->min('start_date');
      $nextAuctionCount = Auction::where('isFinished', false)->count();

      $auction_info = Auction::where('isFinished', false)->orderBy('start_date', 'asc')->first();

      $auction_id = 0;
      if ($nextAuctionCount > 0) {
         $auction_id = $auction_info->id;
      }

      $cars_all = Car::where('status', 'Not sold')
         ->where('brand', 'like', '%' . $brand . '%')
         ->where('fuel', 'like', '%' . $fuel . '%')
         ->where('wheel_drive', 'like', '%' . $wheel_drive . '%')
         ->where('gear', 'like', '%' . $gear . '%')
         ->where('auction', $auction_id)
         ->whereBetween('reg_year', [$year_from, $year_to])
         ->whereBetween('milage', [$milage_from, $milage_to])
         ->whereBetween('min_price', [$price_from, $price_to])
         ->orderBy('id', 'DESC')
         ->get();



      $auctionCount = Auction::count();
      $auctions = Auction::where('isFinished', false);
      $today = Carbon::now()->toDateTimeString();

      $onGoing = Auction::where('isFinished', false)->where('start_date', '<=', $today)
         ->where('end_date', '>', $today)->first();

      if ($onGoing) {
         $onGoing->update([
            'status' => true,
         ]);

         $sold_cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
            ->whereNotNull('auction')->where('auction', '!=', $onGoing->id)->get();

         if ($sold_cars->count() > 0) {
            foreach ($sold_cars as $sold_car) {
               buyerInvoice($sold_car, $sold_car->bidder_id);
               Log::info('117-sold');
               $sold_car->update([
                  'status' => 'sold',
                  'p_id' => $sold_car->bidder_id,
                  'is_in_auction' => false
               ]);
               $current_bidder_data = [
                  'message' => 'Congratulations, you have won the bid.',
                  'bidding_amount' => $sold_car->max_bid,
                  'service_charges' => publishPrice(),
                  'total' => ($sold_car->max_bid + publishPrice()),
                  'brand' => $sold_car->brand,
                  'model' => $sold_car->model,
               ];

               $email = sellerInfo($sold_car->bidder_id)->email;
               Mail::to($email)->send(new BidWon($current_bidder_data));
            }
         }
      } else {
         $cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
            ->get();
         sendSellerInvoice();

         if (count($cars) > 0) {
            foreach ($cars as $car) {
               buyerInvoice($car, $car->bidder_id);
               Log::info('154-else');
               $car->update([
                  'status' => 'sold',
                  'p_id' => $car->bidder_id,
                  'is_in_auction' => false
               ]);
               $current_bidder_data = [
                  'message' => 'Congratulations, you have won the bid.',
                  'bidding_amount' => $car->max_bid,
                  'service_charges' => publishPrice(),
                  'total' => ($car->max_bid + publishPrice()),
                  'brand' => $car->brand,
                  'model' => $car->model,
               ];

               $email = sellerInfo($car->bidder_id)->email;
               Mail::to($email)->send(new BidWon($current_bidder_data));
            }
         }
      }

      $cars_in_auction = Car::whereNotNull('auction')->where('status', 'Not sold')->get();
      if (count($cars_in_auction) > 0) {
         foreach ($cars_in_auction as $car) {
            if ($car->auction) {
               if (!isInCurrentAuction($car->auction)) {
                  if (isCarAuctionFinished($car->auction)) {
                     $car->update([
                        'auction' => null
                     ]);
                  }
               }
            }
         }
      }

      $bidded_cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
         ->get();
      sendSellerInvoice();


      if (count($bidded_cars) > 0) {

         foreach ($bidded_cars as $car) {

            if ($car->auction) {
               if (!isInCurrentAuction($car->auction)) {
                  if (isCarAuctionFinished($car->auction)) {
                     buyerInvoice($car, $car->bidder_id);
                     $car->update([
                        'status' => 'sold',
                        'p_id' => $car->bidder_id,
                        'is_in_auction' => false
                     ]);
                  }
               }
            }
         }
      }

      if ($auctionCount > 0) {
         $endDates = Auction::where('isFinished', false)->where('end_date', '<', $today)->get();
         if ($endDates->count() > 0) {
            foreach ($endDates as $endDate) {
               $endDate->update([
                  'status' => false,
                  'isFinished' => true
               ]);
            }
            $cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
               ->where('is_in_auction', false)->get();
            sendSellerInvoice();

            if (count($cars) > 0) {
               foreach ($cars as $car) {
                  buyerInvoice($car, $car->bidder_id);
                  Log::info('660-else');

                  if (!isInCurrentAuction($car->auction)) {
                     if (isCarAuctionFinished($car->auction)) {
                        $car->update([
                           'status' => 'sold',
                           'p_id' => $car->bidder_id,
                           'is_in_auction' => false
                        ]);
                     }
                  }

                  $current_bidder_data = [
                     'message' => 'Congratulations, you have won the bid.',
                     'bidding_amount' => $car->max_bid,
                     'service_charges' => publishPrice(),
                     'total' => ($car->max_bid + publishPrice()),
                     'brand' => $car->brand,
                     'model' => $car->model,
                  ];

                  $email = sellerInfo($car->bidder_id)->email;
                  Mail::to($email)->send(new BidWon($current_bidder_data));
               }
            }
         }
      }


      $nextAuctionCount = Auction::where('isFinished', false)->count();
      $nextAuction = Auction::where('isFinished', false)->min('start_date');
      $currentAuctionEnd = Auction::where('isFinished', '=', false)->where('status', true)->value('end_date');



      $auctionTitle =  isAuctionActive() ? 'Auction ends in' : 'Auction starts in';
      $endDate = isAuctionActive() ?  $currentAuctionEnd : $nextAuction;
      $endDate =  json_encode($endDate);


      $badges = [];
      $currentAuctionEnd = Auction::where('isFinished', '=', false)->where('status', true)->value('end_date');
      $auctionTitle =  isAuctionActive() ? 'Auction ends in' : 'Auction starts in';
      $endDate = isAuctionActive() ?  $currentAuctionEnd : $nextAuction;
      $endDate =  json_encode($endDate);

      return view('index', [
         'cars' => $cars_all,
         'cars_count' => $cars_all->count(),
         'badges' => $badges,
         'nextAuctionCount' => $nextAuctionCount,
         'auctionTitle' => $auctionTitle,
         'endDate' => $endDate,
      ]);
   }

   public function action(Request $req)
   {
      $brand = $req->get('brand');
      $fuel = $req->get('fuel');
      $gear = $req->get('gear');
      $wheel_drive = $req->get('wheel_drive');
      $year_from = $req->get('year_from');
      $year_to = $req->get('year_to');
      $milage_from = $req->get('milage_from');
      $milage_to = $req->get('milage_to');
      $price_from = $req->get('price_from');
      $price_to = $req->get('price_to');
      $sort = $req->get('sort');
      $today = date('Y');
      $max_milage = Car::max('milage');
      $max_price = Car::max('min_price');

      if (!empty($req->input('year_from'))) {

         $year_from = $req->input('year_from');
      } else {
         $year_from =  -1;
      }
      if (!empty($req->input('year_to'))) {
         $year_to = $req->get('year_to');
      } else {
         $year_to = (int)$today + 1;
      }

      if (!empty($req->input('milage_from'))) {
         $milage_from = $req->get('milage_from');
      } else {
         $milage_from =  -1;
      }

      if (!empty($req->input('milage_to'))) {
         $milage_to = $req->get('milage_to');
      } else {
         $milage_to = $max_milage + 1;
      }

      if (!empty($req->input('price_from'))) {
         $price_from = $req->get('price_from');
      } else {
         $price_from =  -1;
      }

      if (!empty($req->input('price_to'))) {

         $price_to = $req->get('price_to');
      } else {
         $price_to = $max_price + 1;
      }
      if ($sort === 'name-ascending') {
         $orderBy = 'brand';
         $order = 'asc';
      }
      if ($sort === 'name-descending') {
         $orderBy = 'brand';
         $order = 'desc';
      }
      if ($sort === 'registration-ascending') {
         $orderBy = 'first_registration';
         $order = 'asc';
      }
      if ($sort === 'registration-descending') {
         $orderBy = 'first_registration';
         $order = 'desc';
      }
      if ($sort === 'milage-ascending') {
         $orderBy = 'milage';
         $order = 'asc';
      }
      if ($sort === 'milage-descending') {
         $orderBy = 'milage';
         $order = 'desc';
      }
      if ($sort === 'minimum-bid-ascending') {
         $orderBy = 'min_price';
         $order = 'asc';
      }
      if ($sort === 'minimum-bid-descending') {
         $orderBy = 'min_price';
         $order = 'desc';
      }


      $output = '';

      if ($req->ajax()) {
         $data = DB::table('cars')
            ->where('status', 'Not sold')
            ->where('brand', 'like', '%' . $brand . '%')
            ->where('fuel', 'like', '%' . $fuel . '%')
            ->where('wheel_drive', 'like', '%' . $wheel_drive . '%')
            ->where('gear', 'like', '%' . $gear . '%')
            ->whereBetween('reg_year', [$year_from, $year_to])
            ->whereBetween('milage', [$milage_from, $milage_to])
            ->whereBetween('min_price', [$price_from, $price_to])
            ->orderBy('id', 'DESC')
            ->get();


         $tot_row = $data->count();

         if ($tot_row > 0) {

            foreach ($data as $row) {

               $image =  getBadge($row->u_id);
               $url = Storage::url("public/images/memberships/$image");


               if (isset($row->images)) {
                  $img = getImage($row->id);
                  $carImage = Storage::url("public/images/cars/$img");
               } else {
                  $carImage = 'assets/images/car.jpg';
               }


               if (session()->has('client_id')) {
                  if (isset($row->max_bid)) {
                     $max = $row->max_bid;
                  } else {
                     $max = '-';
                  }

                  $max_td = '<td>' . $max . '</td>';
               } else {
                  $max_td = null;
               }


               $output .= '
            <div class="col-md-6">
            <div class="card card-light card-hover card-horizontal mb-4 border">
               <div class="tns-carousel-wrapper card-img-top card-img-hover">
                <a class="img-overlay" href="/car/' . $row->slug . '"></a>
                <div class="position-absolute start-0 top-0 pt-3 ps-3">
                    <span class="d-table badge bg-info">' . getMembership($row->u_id)->title . '</span>
                </div>
                <div class="tns-carousel-inner position-absolute top-0 h-100">';

               Log::info(isset($row->images));
               if ($row->images) {

                  foreach (json_decode($row->images) as $image) {

                     $url = Storage::url("public/images/car/$image");
                     $file_path = storage_path('app/public/images/624ab8e5c7836-1649064165/WhatsApp Image 2022-02-15 at 9.18.18 AM.jpg');
                     $path = asset('storage/images/' . $image);
                     Log::info($path);
                     $output .= ' <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url(\'/assets/images/about-us-hero-img.jpg\');"></div>';
                  }
               }

               $output .= '
                  
               </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between pb-1">
                    <span class="fs-sm text-dark me-3 opacity-50">' . $row->first_registration . '</span>
                </div>
                <h3 class="h6 mb-1">
                    <a class="nav-link" href="/car/' . $row->slug . '">TEST VEHICLE</a>
                </h3> ';

               if (session()->has('client_id')) {
                  $output .= '<div class="text-primary fw-bold mb-1">$' . $row->min_price . '</div>';
               }

               $output .= '<div class="border-top mt-3 pt-3">
                    <div class="row g-2">
                        <div class="col me-sm-1">
                            <div class="rounded text-center w-100 h-100 p-2 border">
                                <i class="fi-dashboard d-block h4 mb-0 mx-center"></i>
                                <span class="fs-xs text-dark">' . $row->milage . ' KM</span>
                            </div>
                        </div>
                        <div class="col me-sm-1">
                            <div class="rounded text-center w-100 h-100 p-2 border">
                                <i class="fi-gearbox d-block h4 mb-0 mx-center"></i>
                                <span class="fs-xs text-dark">' . $row->gear . '</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="rounded text-center w-100 h-100 p-2 border">
                                <i class="fi-petrol d-block h4 mb-0 mx-center"></i>
                                <span class="fs-xs text-dark">' . $row->fuel . '</span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div> 
            </div> 
        </div>';
            }
         } else {

            $output = '<div class="text-center">No data found</div>';
         }
         $data = array(
            'table_data' => $output,
            'item_count' => $tot_row,
         );

         return json_encode($data);
      }
   }


   public function auction(Request $req)
   {
      if ($req->ajax()) {

         if (!empty(request('date'))) {
            $auction = Auction::where('start_date', '=', request('date'))->first();

            $auction->update([
               'status' => true
            ]);
            $data = array(
               'status' => $auction,
            );
            return json_encode($data);
         }
      }
   }
   public function auction_end(Request $req)
   {
      if ($req->ajax()) {
         if (!empty(request('date'))) {
            $auction = Auction::where('end_date', '=', request('date'))->first();
            $auction->update([
               'isFinished' => true,
               'status' => false
            ]);

            $data = array(
               'status' => $auction,
            );

            //update bidded cars after the auction
            $cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')->get();
            if (count($cars) > 0) {
               foreach ($cars as $car) {
                  $car->update([
                     'status' => 'sold',
                     'p_id' => $car->bidder_id,
                  ]);
               }
            }

            return json_encode($data);
         }
      }
   }

   public function instructions()
   {
      return view('instructions');
   }
   public function prices()
   {
      return view('prices');
   }
   public function terms()
   {
      return view('terms-and-conditions');
   }
   public function policy()
   {
      return view('privacy-policy');
   }
   public function about()
   {
      return view('about-us');
   }
   public function jobs()
   {
      return view('jobs');
   }
   public function imprint()
   {
      return view('imprint');
   }
   public function single_car($slug)
   {
      $data = Car::where('slug', $slug)->first();
      if (!$data) {
         return redirect('/');
      }

      $carSold = Car::where('slug', $slug)->where('status', 'Not sold')->firstOrFail();
      if ($carSold->status == 'sold') {
         return redirect('/');
      }


      $auctionCount = Auction::count();
      $auctions = Auction::where('isFinished', false);
      $today = Carbon::now()->toDateTimeString();

      $onGoing = Auction::where('isFinished', false)->where('start_date', '<=', $today)
         ->where('end_date', '>', $today)->first();

      if ($onGoing) {
         $onGoing->update([
            'status' => true,
         ]);

         $sold_cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
            ->whereNotNull('auction')->where('auction', '!=', $onGoing->id)->get();

         if ($sold_cars->count() > 0) {
            foreach ($sold_cars as $sold_car) {
               buyerInvoice($sold_car, $sold_car->bidder_id);
               Log::info('117-sold');
               $sold_car->update([
                  'status' => 'sold',
                  'p_id' => $sold_car->bidder_id,
                  'is_in_auction' => false
               ]);
               $current_bidder_data = [
                  'message' => 'Congratulations, you have won the bid.',
                  'bidding_amount' => $sold_car->max_bid,
                  'service_charges' => publishPrice(),
                  'total' => ($sold_car->max_bid + publishPrice()),
                  'brand' => $sold_car->brand,
                  'model' => $sold_car->model,
               ];

               $email = sellerInfo($sold_car->bidder_id)->email;
               Mail::to($email)->send(new BidWon($current_bidder_data));
            }
         }
      } else {
         $cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
            ->get();
         sendSellerInvoice();

         if (count($cars) > 0) {
            foreach ($cars as $car) {
               buyerInvoice($car, $car->bidder_id);
               Log::info('154-else');
               $car->update([
                  'status' => 'sold',
                  'p_id' => $car->bidder_id,
                  'is_in_auction' => false
               ]);
               $current_bidder_data = [
                  'message' => 'Congratulations, you have won the bid.',
                  'bidding_amount' => $car->max_bid,
                  'service_charges' => publishPrice(),
                  'total' => ($car->max_bid + publishPrice()),
                  'brand' => $car->brand,
                  'model' => $car->model,
               ];

               $email = sellerInfo($car->bidder_id)->email;
               Mail::to($email)->send(new BidWon($current_bidder_data));
            }
         }
      }

      $cars_in_auction = Car::whereNotNull('auction')->where('status', 'Not sold')->get();
      if (count($cars_in_auction) > 0) {
         foreach ($cars_in_auction as $car) {
            if ($car->auction) {
               if (!isInCurrentAuction($car->auction)) {
                  if (isCarAuctionFinished($car->auction)) {
                     $car->update([
                        'auction' => null
                     ]);
                  }
               }
            }
         }
      }

      $bidded_cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
         ->get();
      sendSellerInvoice();


      if (count($bidded_cars) > 0) {

         foreach ($bidded_cars as $car) {

            if ($car->auction) {
               if (!isInCurrentAuction($car->auction)) {
                  if (isCarAuctionFinished($car->auction)) {
                     buyerInvoice($car, $car->bidder_id);
                     $car->update([
                        'status' => 'sold',
                        'p_id' => $car->bidder_id,
                        'is_in_auction' => false
                     ]);
                  }
               }
            }
         }
      }

      if ($auctionCount > 0) {
         $endDates = Auction::where('isFinished', false)->where('end_date', '<', $today)->get();
         if ($endDates->count() > 0) {
            foreach ($endDates as $endDate) {
               $endDate->update([
                  'status' => false,
                  'isFinished' => true
               ]);
            }
            $cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
               ->where('is_in_auction', false)->get();
            sendSellerInvoice();

            if (count($cars) > 0) {
               foreach ($cars as $car) {
                  buyerInvoice($car, $car->bidder_id);
                  Log::info('660-else');

                  if (!isInCurrentAuction($car->auction)) {
                     if (isCarAuctionFinished($car->auction)) {
                        $car->update([
                           'status' => 'sold',
                           'p_id' => $car->bidder_id,
                           'is_in_auction' => false
                        ]);
                     }
                  }

                  $current_bidder_data = [
                     'message' => 'Congratulations, you have won the bid.',
                     'bidding_amount' => $car->max_bid,
                     'service_charges' => publishPrice(),
                     'total' => ($car->max_bid + publishPrice()),
                     'brand' => $car->brand,
                     'model' => $car->model,
                  ];

                  $email = sellerInfo($car->bidder_id)->email;
                  Mail::to($email)->send(new BidWon($current_bidder_data));
               }
            }
         }
      }


      $nextAuctionCount = Auction::where('isFinished', false)->count();
      $nextAuction = Auction::where('isFinished', false)->min('start_date');
      $currentAuctionEnd = Auction::where('isFinished', '=', false)->where('status', true)->value('end_date');



      $auctionTitle =  isAuctionActive() ? 'Auction ends in' : 'Auction starts in';
      $endDate = isAuctionActive() ?  $currentAuctionEnd : $nextAuction;
      $endDate =  json_encode($endDate);

      return view('single-vehicle', [
         'car' => $data,
         'nextAuctionDate' => $nextAuction,
         'currentAuctionEnd' => $currentAuctionEnd,
         'nextAuctionCount' => $nextAuctionCount,
         'title' => $auctionTitle,
         'endDate' => $endDate,
         'publish_price' => publishPrice(),
      ]);
   }

   public function gdrp()
   {
      return view('gdpr');
   }

   public function vehicles()
   {
      $cars = Car::where('status', 'Not sold')->orderBy('id', 'DESC')->paginate(20);
      return view('vehicles', [
         'cars' => $cars
      ]);
   }
}
