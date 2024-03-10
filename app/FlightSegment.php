<?php


namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class FlightSegment extends LocalizableModel
{
    protected $fillable = [
        'package_id', 'flight_id', 'icon', 'flight_number', 'departure_date', 'departure_time', 'arrival_date', 'arrival_time',
        'departure_from_en', 'departure_from_ar', 'arrival_to_en', 'arrival_to_ar', 'flight_en', 'flight_ar'];

    protected $localizable = ['departure_from', 'arrival_to', 'flight'];

    public function flightSegmentFlight()
    {

    }
}
