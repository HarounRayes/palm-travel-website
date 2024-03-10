<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class PackageHotelPricingDetail extends LocalizableModel
{
  protected $fillable =[
      'package_id' ,'hotel_id','package_hotel_id','cost_en','cost_ar','value_en','value_ar'
  ];

  protected $localizable =['cost','value'];
}
