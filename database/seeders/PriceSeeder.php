<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Price::truncate();
        $prices =[
            [
                'name' => 'publishing_price',
                'price' => 50,
            ],
            [
                'name' => 'service_charge',
                'price' => 50,
            ],
            [
                'name' => 'sold_vehicle_price',
                'price' => 50,
            ],
        ];
        Price::insert($prices);
    }
}
