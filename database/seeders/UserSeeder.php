<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            "name"              => "admin",
            "username"         => "admin",
            "email"             => "admin@test.com",
            "email_verified_at" => null,
            "password"          => bcrypt("12345678"),
            "user_type"          => "admin",
            "remember_token"    => null,
            "created_at"        => date("Y-m-d H:i:s"),
            "updated_at"        => null
        ]);
    }
}
