<?php

use App\Mail\BidWon;
use App\Mail\BuyerInvoiceMail;
use App\Mail\SellerInvoiceMail;
use App\Mail\SellerMail;
use App\Models\Auction;
use App\Models\BuyerInvoice;
use App\Models\Car;
use App\Models\CarAuctionCount;
use App\Models\Membership;
use App\Models\Client;
use App\Models\Price;
use App\Models\SellerInvoice;
use App\Models\User;
use App\Models\WishListItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;

function getBadge($cid)
{
  $client = User::findOrFail($cid);
  if (isset($client->membership)) {
    $member = Membership::where('title', $client->membership)->first();
    return $member->image;
  }
  return '';
}
function getMembership($cid)
{
  $client = User::findOrFail($cid);
  if (isset($client->membership)) {
    $member = Membership::where('title', $client->membership)->first();
    return $member;
  }
  return '';
}
function hasMembership($id)
{
  $client = User::findOrFail($id);
  if (isset($client->membership)) {
    return true;
  } else false;
}

function getImage($id)
{
  $car = Car::find($id);
  $img = '';
  if (isset($car)) {
    foreach ($car->images as $i) {
      $img = $i;
    }
    return $img;
  }
  return '';
}


function isAuctionActive()
{
  $isAuctionActive = false;
  $activeAuction = Auction::where('status', true)->where('isFinished', false)->count();

  if (isset($activeAuction)) {
    if ($activeAuction > 0) {
      $isAuctionActive = true;
    }
  }
  return $isAuctionActive;
}

function userDetails($slug)
{
  $car = Car::where('slug', $slug)->first();
  $user = User::find($car->u_id);
  return $user;
}


function countDown()
{

  $nextAuctionCount = Auction::where('isFinished', false)->count();
  $nextAuction = Auction::where('isFinished', false)->min('start_date');
  $currentAuctionEnd = Auction::where('isFinished', '=', false)->where('status', true)->value('end_date');
  $nextAuction = json_encode($nextAuction);
  $currentAuctionEnd = json_encode($currentAuctionEnd);

  if (isAuctionActive()) {
  }
}

function isHighestBidder($car)
{
  $car_info = Car::find($car);

  if (isset($car_info->bidder_id) && session()->has('client_id')) {
    if (session()->get('client_id') == $car_info->bidder_id) {
      return true;
    }
  }
  return false;
}

function isUserCar($car)
{
  $car_info = Car::find($car);
  if (session()->has('client_id')) {
    if ($car_info->u_id == session()->get('client_id')) {
      return true;
    }
  }
  return false;
}


function buyerInfo($id)
{
  $buyer = User::find($id);
  return $buyer;
}
function sellerInfo($id)
{
  $seller = User::find($id);
  return $seller;
}
function bidderInfo($id)
{
  $bidder = User::find($id);
  return $bidder;
}

function isCarSold($id)
{
  $car = Car::find($id);
  if ($car->status === 'sold') {
    return redirect('/');
  }
  return '';
}

function home()
{
  return redirect('/');
}


function generateUniqueCode()
{
  do {
    $code = random_int(1000000, 9999999);
  } while (Car::where("ref_number", "=", $code)->first());

  return $code;
}
function uniqueBuyerInvoiceCode()
{
  do {
    $code = random_int(10000000, 99999999);
  } while (BuyerInvoice::where("ref_number", "=", $code)->first());

  return $code;
}
function uniqueSellerInvoiceCode()
{
  do {
    $code = random_int(10000000, 99999999);
  } while (SellerInvoice::where("ref_number", "=", $code)->first());

  return $code;
}

function isInCurrentAuction($id)
{
  if ($id == null) {
    return false;
  }
  $auction = Auction::find($id);
  if (!$auction) {
    return false;
  }
  if ($auction->isFinished) {
    return false;
  }
  if ($auction->status) {
    return true;
  }
  return true;
}

function isCarAuctionFinished($id)
{
  $auction = Auction::find($id);
  $today = Carbon::now()->toDateTimeString();

  if ($auction) {
    if ($auction->end_date < $today) {
      return true;
    }
  }

  return false;
}

function currentAuction()
{
  $auction = Auction::where('status', true)->first();
  return $auction;
}

function carDetails($id)
{
  $car = Car::find($id);
  return $car;
}

function checkAuctionsEnded()
{

  $auctionCount = Auction::count();
  $today = Carbon::now()->toDateTimeString();

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
      if (count($cars) > 0) {
        foreach ($cars as $car) {
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

function publishPrice()
{
  $price = Price::where('name', 'publishing_price')->first();
  return $price->price;
}
function isWishListed($car_id, $user_id)
{
  $wishlisted = WishListItem::where('car_id', $car_id)->where('user_id', $user_id)->first();
  if ($wishlisted) {
    return true;
  }
  return false;
}

function buyerInvoice($car, $user_id)
{

  $user = User::find($user_id);
  $img = ImageManagerStatic::make('assets/images/invoices/Buyer.jpg');
  $total = $car->max_bid + ($car->max_bid * (7.7 / 100));
  $total = number_format((float)$total, 2, '.', '');
  $total_parts = explode('.', $total);
  $address = buyerInfo($car->bidder_id)->street . ',' . buyerInfo($car->bidder_id)->post_box . ',' . buyerInfo($car->bidder_id)->town . ',' . buyerInfo($car->bidder_id)->postcode . ',' . buyerInfo($car->bidder_id)->country;
  $ref_number = uniqueBuyerInvoiceCode();
  $today = Carbon::now()->toDateString();
  $deadline =  Carbon::now()->addDays(30)->toDateTimeString();


  $img->text($user->company, 430, 360, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($user->first_name . ' ' . $user->surname, 350, 400, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($address, 350, 440, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($user->username, 350, 510, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('CHE-' . number_format($user->ide, 0, ',', '.'), 350, 545, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('fast ide', 350, 580, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('0000000', 380, 615, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($deadline, 350, 655, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($today, 1450, 655, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text($car->brand . ' ' . $car->model, 300, 820, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->ref_number, 300, 850, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->created_at, 300, 885, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->first_registration, 300, 920, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->vehicle_number, 1250, 800, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->frame_number, 1200, 830, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->register_number, 1250, 860, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('CHE-' . number_format($user->ide, 0, ',', '.'), 1250, 890, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->milage, 1190, 920, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text($car->ref_number, 120, 1060, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->brand . ' ' . $car->model, 380, 1060, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($car->max_bid, 880, 1060, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('00000', 1050, 1060, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text(buyerCharge(), 1250, 1060, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text(buyerCharge(), 1250, 1260, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text(number_format((float)(buyerCharge() * (7.7 / 100)), 2, '.', ''), 1250, 1290, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $buyer_total = (buyerCharge() + (buyerCharge() * (7.7 / 100)));
  $buyer_total = number_format((float)$buyer_total, 2, '.', '');
  $buyer_total_parts = explode('.', $buyer_total);
  //number_format($final_total_parts[0], 0, ",", "'")

  $img->text('CHF ' . number_format($buyer_total_parts[0], 0, ",", "'") . '.' . $buyer_total_parts[1], 1250, 1350, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text(buyerInfo($car->bidder_id)->company, 20, 1590, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text(buyerInfo($car->bidder_id)->first_name . ' ' . buyerInfo($car->bidder_id)->surname, 20, 1620, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text($address, 20, 1650, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });

  $img->text(buyerInfo($car->bidder_id)->company, 500, 1590, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text(buyerInfo($car->bidder_id)->first_name . ' ' . buyerInfo($car->bidder_id)->surname, 500, 1620, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($address, 500, 1650, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });

  $img->text('FastAuktion', 20, 1730, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('Chemin de Maillerfer 34', 20, 1760, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('1052 Le Mont Sur Lausanne', 20, 1790, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('FastAuktion', 500, 1730, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('Chemin de Maillerfer 34', 500, 1760, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text('1052 Le Mont Sur Lausanne', 500, 1790, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text($buyer_total_parts[0], 50, 1930, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($buyer_total_parts[1], 400, 1930, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($buyer_total_parts[0], 550, 1930, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($buyer_total_parts[1], 900, 1930, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($ref_number, 1000, 1800, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $img->text(buyerInfo($car->bidder_id)->company, 1000, 1900, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text(buyerInfo($car->bidder_id)->first_name . ' ' . buyerInfo($car->bidder_id)->surname, 1000, 1930, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });
  $img->text($address, 1000, 1960, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('0200000211102>257453000000000000001491054+ 010001458>', 700, 2250, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(22);
  });

  $invoice = uniqid() . '.jpg';
  $img->save($invoice);
  $data = [
    'image' => $invoice
  ];
  $pdf = PDF::loadView('invoice-view', $data);
  $pdf_name = uniqid() . '.pdf';
  Storage::put('public/pdf/' . $pdf_name, $pdf->output());
  File::delete($invoice);

  $buyer_invoice = BuyerInvoice::create([
    'user_id' => $user->id,
    'car_id' => $car->id,
    'type' => 'seller invoice',
    'deadline' => $deadline,
    'total' => $total,
    'invoice' => $pdf_name,
    'ref_number' => $ref_number,
  ]);

  $invoice_data = [
    'message' => 'Congratulations, you successfully bought this car.',
    'bidding_amount' => $car->max_bid,
    'service_charges' => buyerCharge(),
    'total' => $total,
    'brand' => $car->brand,
    'model' => $car->model,   
    'invoice' => $pdf_name,   
];

$email = buyerInfo($car->u_id)->email;
Mail::to($email)->send(new BuyerInvoiceMail($invoice_data));

  
}

function userInvoiceCount($user_id)
{
  $buyer_invoice_count = BuyerInvoice::where('user_id', $user_id)->count();
  $seller_invoice_count = SellerInvoice::where('user_id', $user_id)->count();
  return ($buyer_invoice_count + $seller_invoice_count);
}

function createInvoceSeller($cars, $user_id){
  $user = User::find($user_id);

  $seller_not_sold_cars = Car::where('u_id', $user_id)->where('charged_publishing_price', false)->where('status', 'Not sold')->whereNull('bidder_id')->get();

  $img = ImageManagerStatic::make('assets/images/invoices/seller1.jpg');
  $seller2 = ImageManagerStatic::make('assets/images/invoices/seller2.jpg');
  $address = $user->street . ',' . $user->post_box . ',' . $user->town . ',' . $user->postcode . ',' . $user->country;
  $ref = uniqueSellerInvoiceCode();
  $today = Carbon::now()->toDateString();
  $deadline =  Carbon::now()->addDays(30)->toDateTimeString();

  $img->text($user->company, 310, 410, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($user->first_name . ' ' . $user->surname, 310, 440, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($address, 310, 470, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(17);
  });
  $img->text($user->username, 290, 600, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text('CHE-' . number_format($user->ide, 0, ',', '.'), 290, 630, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text('our Ide', 290, 660, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text('0000000', 320, 695, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($deadline, 270, 725, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($today, 1050, 730, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($user->company, 10, 1195, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($user->first_name . ' ' . $user->surname, 10, 1210, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($address, 10, 1225, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($user->company, 370, 1195, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($user->first_name . ' ' . $user->surname, 370, 1210, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($address, 370, 1225, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Fast Auction AG', 10, 1275, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Chemin de Maillefer 34', 10, 1295, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('1052 Le Mont Sur Lausanne', 10, 1315, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Fast Auction AG', 370, 1275, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Chemin de Maillefer 34', 370, 1295, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('1052 Le Mont Sur Lausanne', 370, 1315, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });


  $img->text($ref, 750, 1350, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Fast Auction AG', 750, 1425, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Chemin de Maillefer 34', 750, 1440, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('1052 Le Mont Sur Lausanne', 750, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Common code', 500, 1700, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });


  //part 2
  $horizontal_value = 210;
  $charges_total = 0;
  foreach ($seller_not_sold_cars as $seller_not_sold_car) {
    $seller2->text($seller_not_sold_car->created_at, 80,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(10);
    });
    $seller2->text($seller_not_sold_car->ref_number, 250,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });
    $seller2->text($seller_not_sold_car->vehicle_number, 350,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });
    $seller2->text(numberOfPublications($seller_not_sold_car->id), 710,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });
    $seller2->text('Not sold', 880,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });
    $seller2->text(publicationCharge(), 980,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });

    $seller_not_sold_car->update([
      'charged_publishing_price' => true
    ]);
    $horizontal_value += 30;
    $charges_total += publicationCharge();
  }

  //foreach ($cars as $car) {
    $car = $cars;
    $price = soldVehicleCharge();
    $seller2->text($car->created_at, 100,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(10);
    });
    $seller2->text($car->ref_number, 250,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });
    $seller2->text($car->vehicle_number, 350,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });
    $seller2->text(numberOfPublications($car->id), 710,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });
    $seller2->text('Sold', 880,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });

    if (!$car->charged_publishing_price) {
      $price += publicationCharge();
    }
    $charges_total += $price;

    $seller2->text($price, 980,  $horizontal_value, function ($font) {
      $font->file('assets/fonts/Raleway-Bold.ttf');
      $font->size(20);
    });

    if (!$car->charged_publishing_price) {
      $car->update([
        'charged_publishing_price' => true
      ]);
    }
    $horizontal_value += 30;
  //}
  $vat_total = $charges_total * (7.7 / 100);
  $vat_total = number_format((float)$vat_total, 2, '.', '');

  $final_total = (float) ($charges_total + $vat_total);
  $final_total_parts = explode('.', $final_total);

  $img->text($charges_total, 990, 950, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($vat_total, 990, 980, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });

  $img->text(number_format($final_total_parts[0], 0, ",", "'") . '.' . $final_total_parts[1], 990, 1010, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });

  $img->text(number_format($final_total_parts[0], 0, ",", "'"), 70, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($final_total_parts[1], 290, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text(number_format($final_total_parts[0], 0, ",", "'"), 450, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($final_total_parts[1], 650, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });

  $seller2->text('Total', 100,  $horizontal_value + 30, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text($charges_total, 980,  $horizontal_value + 30, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });


  $seller2->text('VAT 7.7%', 100,  $horizontal_value + 60, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text($vat_total, 980,  $horizontal_value + 60, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text('Total VAT invoice incl.', 100,  $horizontal_value + 90, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text(($charges_total + $vat_total), 980,  $horizontal_value + 90, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });

  $invoice = uniqid() . '.jpg';
  $invoice_2 = uniqid() . '.jpg';
  $img->save($invoice);
  $seller2->save($invoice_2);
  $data = [
    'image' => $invoice,
    'image2' => $invoice_2,
  ];

  $pdf = PDF::loadView('seller-invoice', $data);
  $pdf_name = uniqid() . '.pdf';
  Storage::put('public/pdf/' . $pdf_name, $pdf->output());
  File::delete($invoice);
  File::delete($invoice_2);

  $seller_invoice = SellerInvoice::create([
    'user_id' => $user->id,
    'car_id' => $cars->id,
    'type' => 'seller invoice',
    'deadline' => $deadline,
    'total' => ($charges_total + $vat_total),
    'invoice' => $pdf_name,
    'ref_number' => $ref,
  ]); 

  $invoice_data = [
    'message' => 'Congratulations, your car has been sold.',
    'bidding_amount' => $car->max_bid,
    'service_charges' => publishPrice(),
    'total' => ($charges_total + $vat_total),
    'brand' => $car->brand,
    'model' => $car->model,   
    'invoice' => $pdf_name,   
  ];
  return $invoice_data;


}
function sellerInvoice($car, $user_id) 
{
  $invoice_data = createInvoceSeller($car, $user_id);
  
  $email = sellerInfo($car->u_id)->email;
  Mail::to($email)->send(new SellerInvoiceMail($invoice_data));

}

function singleSellerInvoice($car, $user_id)
{
  $user = User::find($user_id);

  $img = ImageManagerStatic::make('assets/images/invoices/seller1.jpg');
  $seller2 = ImageManagerStatic::make('assets/images/invoices/seller2.jpg');
  $address = $user->street . ',' . $user->post_box . ',' . $user->town . ',' . $user->postcode . ',' . $user->country;
  $ref = uniqueSellerInvoiceCode();
  $today = Carbon::now()->toDateString();
  $deadline =  Carbon::now()->addDays(7)->toDateTimeString();

  $img->text($user->company, 310, 410, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($user->first_name . ' ' . $user->surname, 310, 440, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($address, 310, 470, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(17);
  });
  $img->text($user->username, 290, 600, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text('CHE-' . number_format($user->ide, 0, ',', '.'), 290, 630, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text('our Ide', 290, 660, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text('0000000', 320, 695, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($deadline, 270, 725, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($today, 1050, 730, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($user->company, 10, 1195, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($user->first_name . ' ' . $user->surname, 10, 1210, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($address, 10, 1225, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($user->company, 370, 1195, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($user->first_name . ' ' . $user->surname, 370, 1210, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($address, 370, 1225, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Fast Auction AG', 10, 1275, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Chemin de Maillefer 34', 10, 1295, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('1052 Le Mont Sur Lausanne', 10, 1315, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Fast Auction AG', 370, 1275, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Chemin de Maillefer 34', 370, 1295, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('1052 Le Mont Sur Lausanne', 370, 1315, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });


  $img->text($ref, 750, 1350, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Fast Auction AG', 750, 1425, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Chemin de Maillefer 34', 750, 1440, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('1052 Le Mont Sur Lausanne', 750, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text('Common code', 500, 1700, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });

  //part 2
  $horizontal_value = 210;
  $charges_total = 0;

  $price = soldVehicleCharge();
  $seller2->text($car->created_at, 100,  $horizontal_value, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(10);
  });
  $seller2->text($car->ref_number, 250,  $horizontal_value, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text($car->vehicle_number, 350,  $horizontal_value, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text(numberOfPublications($car->id), 710,  $horizontal_value, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text('Sold', 880,  $horizontal_value, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });

  if (!$car->charged_publishing_price) {
    $price += publicationCharge();
  }
  $charges_total += $price;

  $seller2->text($price, 980,  $horizontal_value, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });

  if (!$car->charged_publishing_price) {
    $car->update([
      'charged_publishing_price' => true
    ]);
  }


  $vat_total = $charges_total * (7.7 / 100);
  $vat_total = number_format((float)$vat_total, 2, '.', '');

  $final_total = (float) ($charges_total + $vat_total);
  $final_total_parts = explode('.', $final_total);

  $img->text($charges_total, 990, 950, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });
  $img->text($vat_total, 990, 980, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });

  $img->text(number_format($final_total_parts[0], 0, ",", "'") . '.' . $final_total_parts[1], 990, 1010, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(23);
  });

  $img->text(number_format($final_total_parts[0], 0, ",", "'"), 70, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($final_total_parts[1], 290, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text(number_format($final_total_parts[0], 0, ",", "'"), 450, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });
  $img->text($final_total_parts[1], 650, 1455, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(16);
  });

  $seller2->text('Total', 100,  $horizontal_value + 30, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text($charges_total, 980,  $horizontal_value + 30, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });


  $seller2->text('VAT 7.7%', 100,  $horizontal_value + 60, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text($vat_total, 980,  $horizontal_value + 60, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text('Total VAT invoice incl.', 100,  $horizontal_value + 90, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });
  $seller2->text(($charges_total + $vat_total), 980,  $horizontal_value + 90, function ($font) {
    $font->file('assets/fonts/Raleway-Bold.ttf');
    $font->size(20);
  });

  $invoice = uniqid() . '.jpg';
  $invoice_2 = uniqid() . '.jpg';
  $img->save($invoice);
  $seller2->save($invoice_2);
  $data = [
    'image' => $invoice,
    'image2' => $invoice_2,
  ];

  $pdf = PDF::loadView('seller-invoice', $data);
  $pdf_name = uniqid() . '.pdf';
  Storage::put('public/pdf/' . $pdf_name, $pdf->output());
  File::delete($invoice);
  File::delete($invoice_2);

  $seller_invoice = SellerInvoice::create([
    'user_id' => $user->id,
    'car_id' => 2,
    'type' => 'seller invoice',
    'deadline' => $deadline,
    'total' => ($charges_total + $vat_total),
    'invoice' => $pdf_name,
    'ref_number' => $ref,
  ]);

  $invoice_data = [
    'message' => 'Congratulations, your car has been sold.',
    'bidding_amount' => $car->max_bid,
    'service_charges' => publishPrice(),
    'total' => ($charges_total + $vat_total),
    'brand' => $car->brand,
    'model' => $car->model,   
    'invoice' => $pdf_name,   
];

$email = sellerInfo($car->u_id)->email;
Mail::to($email)->send(new SellerInvoiceMail($invoice_data));
}


function sendSellerInvoice()
{
  $today = Carbon::now()->toDateTimeString();
  $onGoing = Auction::where('isFinished', false)->where('start_date', '<=', $today)
    ->where('end_date', '>', $today)->first();

  if ($onGoing) { 
    Log::info('if');
    $unique_auctions = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
      ->where('auction', '!=', $onGoing->id)->get()->unique('auction');

    if (count($unique_auctions) > 0) {
      foreach ($unique_auctions as $unique_auction) {
        $unique_sellers = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
          ->where('auction', $unique_auction->auction)->get()->unique('u_id');

        foreach ($unique_sellers as  $unique_seller) {
          $sellers_cars =  Car::where('status', 'Not sold')->whereNotNull('bidder_id')
            ->where('auction', $unique_auction->auction)->where('u_id', $unique_seller->u_id)->get();

          if (count($sellers_cars) > 0) {
            SellerInvoice($sellers_cars, $unique_seller->u_id);
          }
        }
      }
    }
  } else {
    $unique_auctions = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
      ->get()->unique('auction');
    if (count($unique_auctions) > 0) {
      foreach ($unique_auctions as $unique_auction) {
        $unique_sellers = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
          ->where('auction', $unique_auction->auction)->get()->unique('u_id');

        foreach ($unique_sellers as  $unique_seller) {
          $sellers_cars =  Car::where('status', 'Not sold')->whereNotNull('bidder_id')
            ->where('auction', $unique_auction->auction)->where('u_id', $unique_seller->u_id)->get();

          if (count($sellers_cars) > 0) {
            SellerInvoice($sellers_cars, $unique_seller->u_id);
          }
        }
      }
    }
  }
}

function buyerCharge()
{
  $service_charge = Price::where('name', 'service_charge')->first();
  return $service_charge->price;
}
function publicationCharge()
{
  $publication_charge = Price::where('name', 'publishing_price')->first();
  return $publication_charge->price;
}
function soldVehicleCharge()
{
  $sold_charge = Price::where('name', 'sold_vehicle_price')->first();
  return $sold_charge->price;
}

function numberOfPublications($car_id)
{
  $count = CarAuctionCount::where('car_id', $car_id)->get()->count();
  return $count;
}

function auctionChecker()
{
  $auctionCount = Auction::count();
  $today = Carbon::now()->toDateTimeString();

  $onGoing = Auction::where('isFinished', false)->where('start_date', '<=', $today)
    ->where('end_date', '>', $today)->first();

  if ($onGoing) {
    $onGoing->update([
      'status' => true,
    ]);

    $sold_cars = Car::where('status', 'Not sold')->whereNotNull('bidder_id')
      ->whereNotNull('auction')->where('auction', '!=', $onGoing->id)->get();
    sendSellerInvoice();
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
}
