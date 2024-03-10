<?php

namespace App;

use App\Scopes\CompleteEnquiryScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'package_hotel_id', 'hotel_id', 'package_id', 'country_id', 'city_id', 'member_id',
        'num_room', 'name', 'email', 'phone', 'address', 'message', 'cost',
        'status', 'custom', 'accepted', 'view', 'complete','is_enquiry' ,'is_paid'
    ];
    public $enums = ['status', 'custom', 'accepted', 'view'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompleteEnquiryScope());
        static::deleted(function ($invoice) {
            $invoice->rooms()->delete();
            $invoice->tours()->delete();
        });
    }

    public function packageHotel()
    {
        return $this->hasOne(PackageHotel::class, 'id', 'package_hotel_id')->withTrashed();
    }

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id')->withTrashed();
    }

    public function hotel()
    {
        return $this->hasOne(Hotel::class, 'id', 'hotel_id')->withTrashed();
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id')->withTrashed();
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id')->withTrashed();
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'enquiry_id', 'id')->withTrashed();
    }

    public function tours()
    {
        return $this->hasMany(EnquiryTour::class, 'enquiry_id', 'id')->withTrashed();
    }

    public function number_of_person()
    {
        $number = 0;
        foreach ($this->rooms as $room) {
            $number += $room['num_adult'];
            $number += $room['num_child'];
        }
        return $number;
    }

    public function enquiry_name()
    {
        if ($this->member)
            return $this->member->name;
        else
            return $this->name;
    }

    public function enquiry_email()
    {
        if ($this->member)
            return $this->member->email;
        else
            return $this->email;
    }

    public function enquiry_phone()
    {
        if ($this->member)
            return $this->member->phone;
        else
            return $this->phone;
    }

    public function transaction()
    {
        return $this->hasOne(EnquiryTransaction::class, 'enquiry_id', 'id');
    }
}
