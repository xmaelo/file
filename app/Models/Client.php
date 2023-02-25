<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'client';

    protected $fillable = [
        'company', 'addition', 'street','post_box','postcode','town','country','car_dealership',
        'motorcycle_dealership','commercial_vehicle_dealership','form_of_address','first_name',
        'surname','email','phone','mobile','lang','user_name','pw','membership'
    ];

    protected $hidden = [
        'pw', 'remember_token',
    ];
 
}
