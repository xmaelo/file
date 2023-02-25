<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::truncate();
        $cars = [
            [
                "brand" => "aaa",
                "model" => "ffsssf",
                "type" => "ddd",
                "body_type" => "aaa",
                "doors" => "4",
                "first_registration" => date("Y-m-d"),
                "reg_year" => 2020,
                "milage" => 66666,
                "exterior_color" => "Anthracite",
                "exterior_finish" => "dgd",
                "interior_color" => "fdgdg",
                "interior_finish" => "dfgdg",
                "special_equipments" => "fdg",
                "serial_equipments" => "gfgdg",
                "wheel_drive" => "4x4",
                "gear" => "Automatic",
                "fuel" => "Petrol",
                "displacement" => "3",
                "performance_hp" => "34",
                "performance_kw" => "43",
                "seats" => "3",
                "frame_number" => "34",
                "model_number" => "34",
                "vehicle_number" => "34344",
                "register_number" => "344",
                "direct_import" => "true",
                "additional_info" => "dfsdf",
                "factory_price" => "4343",               
                "general_conditions" => null,
                "registration_document" => "Available",
                "service_record_booklet" => "Available",
                "inspection" => date("2022-02-20"),
                "repairs" => "3",
                "service_record_digital" => "Available",
                "keys" => "2",
                "mechanics" => "dsfsf",
                "body" => "dsffdsf",
                "car_finish" => "sfdfs",
                "others" => "fdfdsfs",
                "documents" => null,
                "images" => null,
                "min_price" => 8888,
                "location" => "SW",               
                "status" => "Not sold",
                "bidder_id" => null,
                "slug" => Str::random(15),
                'u_id' => '1',
                "p_id" => null,
                "max_bid" => null,
                "end_auction" => null,
                "is_in_auction" => false,
                "created_at"        => date("Y-m-d H:i:s"),
                "updated_at"        => null,
                "auction"        => null
            ],
            [
                "brand" => "bbb",
                "model" => "ffsssf",
                "type" => "ddd",
                "body_type" => "bbb",
                "doors" => "4",
                "first_registration" => date("Y-m-d"),
                "reg_year" => 2021,
                "milage" => 7777,
                "exterior_color" => "Anthracite",
                "exterior_finish" => "dgd",
                "interior_color" => "fdgdg",
                "interior_finish" => "dfgdg",
                "special_equipments" => "fdg",
                "serial_equipments" => "gfgdg",
                "wheel_drive" => "4x4",
                "gear" => "Automatic",
                "fuel" => "Petrol",
                "displacement" => "3",
                "performance_hp" => "34",
                "performance_kw" => "43",
                "seats" => "3",
                "frame_number" => "34",
                "model_number" => "34",
                "vehicle_number" => "34344",
                "register_number" => "344",
                "direct_import" => "true",
                "additional_info" => "dfsdf",
                "factory_price" => "4343",               
                "general_conditions" => null,
                "registration_document" => "Available",
                "service_record_booklet" => "Available",
                "inspection" => date("2022-02-20"),
                "repairs" => "3",
                "service_record_digital" => "Available",
                "keys" => "2",
                "mechanics" => "dsfsf",
                "body" => "dsffdsf",
                "car_finish" => "sfdfs",
                "others" => "fdfdsfs",
                "documents" => null,
                "images" => null,
                "min_price" => 9999,
                "location" => "SW",               
                "status" => "Not sold",
                "bidder_id" => null,
                "slug" => Str::random(15),
                'u_id' => '1',
                "p_id" => null,
                "max_bid" => null,
                "end_auction" => null,
                "is_in_auction" => false,
                "created_at"        => date("Y-m-d H:i:s"),
                "updated_at"        => null,
                "auction"        => null,
            ],
        ];


        Car::insert($cars);
    }
}
