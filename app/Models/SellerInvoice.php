<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerInvoice extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'auction',
        'type',
        'deadline',
        'total',
        'invoice',
        'ref_number',
        'paid',
        'paid_date',
        'email_send_counter'
    ];
}
