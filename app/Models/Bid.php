<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['car_id', 'bidder_id', 'auction_id', 'bid_amount', 'owner_id','status'];

    protected $dates = ['deleted_at'];
}
