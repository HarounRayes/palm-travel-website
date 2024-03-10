<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageHotelSegment extends Model
{
    protected $fillable = ['package_id', 'hotel_id','package_hotel_id', 'room_details_en', 'room_details_ar', 'check_in', 'check_out','main_hotel_id'];

    public function hotel(){
        return $this->hasOne(Hotel::class,'id','hotel_id');
    }
    public function getCheckInFormate() {
        if (app()->getLocale() == 'ar'){
            if ($this->check_in == 0) {
                return '0000-00-00';
            } else {
                return date("Y-m-d", strtotime($this->check_in));
            }
        } else {
            if ($this->check_in == 0) {
                return '00-00-0000';
            } else {
                return date("d-m-Y", strtotime($this->check_in));
            }
        }
    }
    public function getCheckOutFormate() {
        if (app()->getLocale() == 'ar'){
            if ($this->check_out == 0) {
                return '0000-00-00';
            } else {
                return date("Y-m-d", strtotime($this->check_out));
            }
        } else {
            if ($this->check_out == 0) {
                return '00-00-0000';
            } else {
                return date("d-m-Y", strtotime($this->check_out));
            }
        }
    }
}
