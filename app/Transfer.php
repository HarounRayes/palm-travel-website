<?php


namespace App;


use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class Transfer extends LocalizableModel
{
    protected $fillable = ['package_id', 'date', 'time', 'type_en', 'type_ar', 'pickup_location_en', 'pickup_location_ar', 'drop_off_location_ar', 'drop_off_location_en','image'];
    protected $localizable = ['type', 'pickup_location', 'drop_off_location'];

}
