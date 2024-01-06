<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnquiryTour extends Model
{
   use SoftDeletes;
   protected $fillable = ['enquiry_id' ,'tour_id','member_id','book_id','day_id',
       'adult_number' ,'child_number' ,'child_age_1' ,'child_age_2','tour_cost' ,'number_day','child_number_2'
   ];
   public function tour(){
       return $this->hasOne(Tour::class,'id','tour_id')->withTrashed();
   }
}
