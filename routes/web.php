<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\WishListItemController;
use App\Models\Client;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes([
    'register' => false,
    'verify' => true,
]);

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/action', 'action')->name('action');
    Route::get('/auction', 'auction')->name('auction');
    Route::get('/auction-end', 'auction_end')->name('auction_end');
    Route::get('/vehicles', 'vehicles');
    Route::get('/how-it-works/instructions', 'instructions');
    Route::get('/how-it-works/prices', 'prices');
    Route::get('/how-it-works/terms', 'terms');
    Route::get('/how-it-works/policy', 'policy');
    Route::get('/fastauktion/about', 'about');
    Route::get('/fastauktion/jobs', 'jobs');
    Route::get('/fastauktion/imprint', 'imprint');
    Route::get('/gdrp', 'gdrp');
    Route::get('/car/{slug}', 'single_car');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/admin/users', 'index');
    Route::get('/accounts/car/sell', 'sell_car');
    Route::get('/accounts/invoices', 'invoices');
    Route::get('/admin/users/{user}', 'show');
    Route::get('/auth/verify-email/{verification_code}', 'verify_email')->name('verify_email');
    Route::post('/accounts/register', 'register');
    Route::post('/accounts/car/sell', 'store');
    Route::post('/upload', 'upload');
    Route::put('accounts/profile/update', 'client_data');
    Route::put('/admin/users', 'update');
    Route::put('/admin/users/accept', 'user_accept');
    Route::put('/admin/users/reject', 'user_reject');
    Route::delete('/admin/users/{user}', 'destroy');
});

Route::controller(CarController::class)->group(function () {
    Route::get('/accounts/current-vehicles', 'current_vehicles')->name('current-vehicles');
    Route::get('/accounts/current-vehicle/{slug}', 'current_vehicle');
    Route::get('/accounts/current-vehicle/{slug}/edit', 'current_vehicle_edit');
    Route::get('/accounts/sold-vehicles', 'sold_vehicles');
    Route::get('/accounts/sold-vehicle/{slug}', 'sold_vehicle_show');
    Route::get('/accounts/purchased-vehicles', 'purchased_vehicles');
    Route::get('/accounts/purchased-vehicle/{slug}', 'purchased_vehicle_show');
    Route::get('/admin/cars', 'index');
    Route::get('/admin/sold-cars', 'sold_cars');
    Route::get('/admin/cars/{car}', 'show');
    Route::get('/admin/search-cars', 'search');
    Route::get('/accounts/dashboard', 'dashboard');
    Route::put('/bid', 'customer_bid');
    Route::put('/accounts/current-vehicle/{slug}/update', 'current_vehicle_update');
    Route::put('/accounts/current-vehicle/{id}/auction', 'current_vehicle_auction');
    Route::delete('/admin/cars/{car}', 'destroy');
});

Route::controller(AccountsController::class)->group(function () {
    Route::get('/reset-password/{token}', 'reset_password')->name('password.reset1');
    Route::get('/admin/accounts/login', 'login');
    Route::get('/admin/accounts/logout', 'logout');
    Route::get('/admin/logout', 'logout_function');
    Route::post('/forgot-password', 'forgot_password')->name('password.email1');
    Route::post('/reset-password', 'reset_password_update')->name('password.update1');
});

Route::controller(PriceController::class)->group(function () {
    Route::get('/admin/prices', 'index');
    Route::get('/admin/prices/{price}', 'show');
    Route::put('/admin/prices/{price}', 'update');    
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::controller(WishListItemController::class)->group(function () {
    Route::get('/wishlist','index');
    Route::post('/wishlist','store'); 
});


Route::post('/accounts/login', [ClientLoginController::class, 'login']);
Route::get('/accounts/profile', [ClientLoginController::class, 'profile'])->name('user.profile');
Route::put('/accounts/password', [ClientLoginController::class, 'password']);
Route::get('/accounts/logout', [ClientLoginController::class, 'logout_client'])->name('logout_client');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['isAdmin']);

Route::get('/admin/schedule', [AuctionController::class, 'index']);
Route::post('/admin/schedule', [AuctionController::class, 'store']);
Route::delete('/admin/schedule/{auction}', [AuctionController::class, 'destroy']);

Route::get('/admin/memberships', [MembershipController::class, 'index']);
Route::post('/admin/memberships', [MembershipController::class, 'create']);
Route::get('/admin/memberships/{membership}', [MembershipController::class, 'edit']);
Route::put('/admin/memberships/{membership}', [MembershipController::class, 'update']);
Route::delete('/admin/memberships/{membership}', [MembershipController::class, 'destroy']);

Route::get('/admin/accounts/profile', [UserController::class, 'index']);
Route::put('/admin/accounts/profile', [UserController::class, 'store']);

Route::put('/bid-accept', [BidController::class, 'bid_accept']);
Route::put('/bid-cancel', [BidController::class, 'bid_cancel']);
Route::put('/bid-user-delete/{bid}', [BidController::class, 'user_bid_delete']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
