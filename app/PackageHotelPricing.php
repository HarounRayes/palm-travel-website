<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageHotelPricing extends Model
{
  protected $fillable =[
      'package_id' ,'hotel_id','package_hotel_id','adult_1','adult_2','adult_3','child_0_2_1','child_0_2_2','child_0_2_3','child_3_5_1',
      'child_3_5_1','child_3_5_2','child_3_5_3','child_6_11_1','child_6_11_2','child_6_11_3'
  ];
}
