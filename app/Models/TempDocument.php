<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDocument extends Model
{
    use HasFactory;
    protected $fillable =[
        'filename','folder','u_id'
    ];
}
