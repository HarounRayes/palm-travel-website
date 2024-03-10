<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HolidayPrice extends Model
{
    protected $fillable=['package_id' , 'hotel_id' ,'type_en' ,'type_ar' , 'value_en' ,'value_ar'];
}
