<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =['start_date','end_date','isFinished','status' ];
    protected $dates = ['deleted_at'];
}
