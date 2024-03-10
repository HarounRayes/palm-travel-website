<?php


namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class Flight extends LocalizableModel
{
    protected $fillable = ['package_id', 'departure_from_en', 'departure_from_ar', 'departure_to_en', 'departure_to_ar'];
    protected $localizable = ['departure_from', 'departure_to'];

    public function segments()
    {
        return $this->hasMany(FlightSegment::class, 'flight_id', 'id')->where('package_id', $this->package_id);
    }

}
