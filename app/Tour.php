<?php


namespace App;


use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;

class Tour extends LocalizableModel
{
    use SoftDeletes;

    protected $fillable = ['name_en', 'name_ar', 'text_en', 'text_ar', 'image_en', 'image_ar', 'country_id', 'city_id',
        'price_1', 'price_2', 'price_3', 'child_0_2', 'child_2_12', 'child_12', 'is_car', 'is_bus', 'price_bus'];
    protected $localizable = ['name', 'text', 'image'];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function tourByUser($day)
    {
        return OrderTour::where('tour_id', $this->id)->where('day_id', $day)->where('session_id', Session::getId())->first();
    }
    public function tourByUserCost($day){
        $OrderTour = OrderTour::where('tour_id', $this->id)->where('day_id', $day)->where('session_id', Session::getId())->first();
        $tourByUser = $this->tourByUser($day);
        $result = 0;
        if ($OrderTour->type == "1") {
            if ($tourByUser->adult_number > 8 && $tourByUser->adult_number <= 12) {
                $result += $this->price_3;
            } elseif ($tourByUser->adult_number > 4 && $tourByUser->adult_number <= 8) {
                $result +=  $this->price_2;
            } elseif ($tourByUser->adult_number > 0 && $tourByUser->adult_number <= 4) {
                $result +=  $this->price_1;
            }
        } elseif($OrderTour->type == "2") {
            $result = $tourByUser->adult_number * $this->price_bus;
            $result +=  $tourByUser->child_number * $this->child_0_2;
            $result += $tourByUser->child_number * $this->child_2_12;
        }
        return $result;

    }
    public function allToursInCity(){
        return Tour::where('city_id' ,$this->city_id)->get();
    }

}
