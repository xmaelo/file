<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
     protected $fillable =[
        'brand', 'model','type','body_type','doors','first_registration','milage',
        'exterior_color','exterior_finish','interior_color','interior_finish','special_equipments',
        'serial_equipments','wheel_drive','gear','fuel','displacement','performance_hp','seats',
        'frame_number','model_number','vehicle_number','register_number', 'direct_import','additional_info'
        ,'factory_price','publish','general_conditions','registration_document','service_record_booklet',
        'inspection','repairs','service_record_digital','keys','mechanics','body','car_finish',
        'others','documents','images','min_price','location','performance_kw','status','bidder_id',
        "slug","u_id","p_id","reg_year","max_bid","end_auction","is_in_auction",'ref_number' ,'auction',
        'charged_publishing_price'   
    ];

     protected $casts = [
        'general_conditions' => 'array',
        'documents' => 'array',
        'images' => 'array',
    ];
}
