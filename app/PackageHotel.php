<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageHotel extends LocalizableModel
{
    use SoftDeletes;
    protected $fillable = ['package_id', 'hotel_id', 'price', 'check_in', 'check_out', 'room_details_en',
        'room_details_ar', 'bookable', 'enquiry', 'sold_out'];

    protected $localizable = ['room_details'];

    public function hotel()
    {
        return $this->hasOne(Hotel::class, 'id', 'hotel_id');
    }

    public function hotelPricing()
    {
        return $this->hasOne(PackageHotelPricing::class, 'package_hotel_id', 'id');
    }

    public function hotelPricingDetails()
    {
        return $this->hasMany(PackageHotelPricingDetail::class, 'package_hotel_id', 'id');
    }

    public function segments()
    {
        return $this->hasMany(PackageHotelSegment::class, 'package_hotel_id', 'id');
    }

    public function getCheckInFormate()
    {
        if (app()->getLocale() == 'ar') {
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

    public function getCheckOutFormate()
    {
        if (app()->getLocale() == 'ar') {
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
