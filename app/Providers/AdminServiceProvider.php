<?php

namespace App\Providers;

use App\Models\Auction;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $users = User::where('user_type', 'user')->where('isApproved', false)->count();
        $cars = Car::where('status', 'Not sold')->count();
        $auctions = Auction::where('isFinished', false)->count();
        $sold_cars = Car::where('status', 'sold')->count();
        $all_cars = Car::all()->count();

        $this->ItemsCounts = [$users, $cars, $auctions, $sold_cars, $all_cars];

        view()->composer('layouts.admin', function ($view) {
            $view->with(['contents' => $this->ItemsCounts]);
        });
    }
}
