<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityTourCategory extends LocalizableModel
{
    use SoftDeletes;

    protected $fillable = [
        'activity_tour_id', 'activity_category_id', 'type',
        'adult_price', 'infant_price', 'child_3_5_price',
        'child_6_11_price', 'person_1_4_price', 'person_1_8_price',
        'person_1_12_price',
        'shared_note_ar', 'shared_note_en',
        'private_note_ar', 'private_note_en','private_is_shared'
    ];
    protected $localizable = ['shared_note' ,'private_note'];

    public function category()
    {
        return $this->hasOne(ActivityCategory::class, 'id', 'activity_category_id');
    }

    public function totalPrice($adult, $child_age_1, $child_age_2, $person_number = 0)
    {
        if ($this->type == 'shared') {
            $price = $adult * $this->adult_price;
            if ($child_age_1 > 0 && $child_age_1 < 3) {
                $price = $price + $this->infant_price;
            } else if ($child_age_1 > 2 && $child_age_1 < 6) {
                $price = $price + $this->child_3_5_price;
            } else if ($child_age_1 > 5 && $child_age_1 < 12) {
                $price = $price + $this->child_6_11_price;
            }

            if ($child_age_2 > 0 && $child_age_2 < 3) {
                $price = $price + $this->infant_price;
            } else if ($child_age_2 > 2 && $child_age_2 < 6) {
                $price = $price + $this->child_3_5_price;
            } else if ($child_age_2 > 5 && $child_age_2 < 12) {
                $price = $price + $this->child_6_11_price;
            }
        } else {

            $price = 0;
            if ($person_number > 0 && $person_number < 5) {
                $price = $price + $this->person_1_4_price;
            } else if ($person_number > 4 && $person_number < 9) {
                $price = $price + $this->person_1_8_price;
            } else if ($person_number > 8 && $person_number < 13) {
                $price = $price + $this->person_1_12_price;
            }
        }
        return $price;
    }
}
