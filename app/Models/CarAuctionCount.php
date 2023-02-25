<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAuctionCount extends Model
{
    use HasFactory;
    protected $fillable =[
        'auction',
        'car_id',
    ];
}
