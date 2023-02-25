<?php

namespace App\Providers;

use App\Models\Auction;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
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

        $nextAuction = Auction::where('isFinished', false)->min('start_date');
        $currentAuctionEnd = Auction::where('isFinished', '=', false)->where('status', true)->value('end_date');

        $nextAuction = json_encode($nextAuction);
        $currentAuctionEnd = json_encode($currentAuctionEnd);

        $isAuctionActive = isAuctionActive();

        $auctionTitle =  isAuctionActive() ? 'Auction ends in' : 'Auction starts in';
      

        $this->nextAuction = $nextAuction;
        $this->currentAuctionEnd = $currentAuctionEnd;
        $this->isAuctionActive = $isAuctionActive;
        $this->auctionTitle =  $auctionTitle;


        view()->composer('layouts.layout', function ($view) {
            $view->with([
                'nextAuction' => $this->nextAuction,
                'currentAuctionEnd' => $this->currentAuctionEnd,
               
            ]);
        });
    }
}
