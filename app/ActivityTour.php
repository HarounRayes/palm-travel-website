<?php

namespace App;

use App\I18n\LocalizableModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ActivityTour extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'name_en', 'name_ar',
        'intro_en', 'intro_ar',
        'overview_en', 'overview_ar',
        'info_en', 'info_ar',
        'term_en', 'term_ar',
        'image_en', 'image_ar',
        'deadline_en', 'deadline_ar',
        'activity_country_id', 'activity_city_id',
        'activity_duration', 'activity_service', 'activity_for',
        'price', 'date', 'cancellation_date', 'symbol',
        'private', 'shared','add_to_home',
        'created_by', 'updated_by'
    ];
    protected $localizable = [
        'name', 'intro', 'overview', 'term', 'image', 'info', 'deadline'
    ];


    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('activities.tours.create.en', 'activities.tours.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }
    }

    protected static function boot() {
        parent::boot();

        static::deleted(function ($tour) {
            $tour->inclusions()->delete();
            $tour->exclusions()->delete();
            $tour->categories()->delete();
            $tour->images()->delete();
            $tour->tourTypes()->delete();
        });
    }

    public function country()
    {
        return $this->hasOne(ActivityCountry::class, 'id', 'activity_country_id');
    }

    public function city()
    {
        return $this->hasOne(ActivityCity::class, 'id', 'activity_city_id');
    }

    public function inclusions()
    {
        return $this->hasMany(ActivityInclusion::class, 'activity_tour_id', 'id');
    }

    public function exclusions()
    {
        return $this->hasMany(ActivityExclusion::class, 'activity_tour_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(ActivityTourCategory::class, 'activity_tour_id', 'id');
    }


    public function activityIsInCard($activity_category_id)
    {
        if (!Auth::guard('member')->user()) {
            return false;
        } else {
            $result = ActivityCard::where('activity_tour_id', $this->id)
                ->where('activity_category_id', $activity_category_id)
                ->where('member_id', Auth::guard('member')->user()->getAuthIdentifier())
                ->whereHas('orderNotBook')
                ->first();
            if ($result)
                return $result;
            else
                return false;
        }
    }

    public function totalPrice($adult, $person_number, $ageChild,$activity_id, $category_id)
    {
        $category_tour = ActivityTourCategory::where('activity_tour_id' , $activity_id)->where('activity_category_id' , $category_id)->first();
        $price = 0;
        if ($category_tour->type == "shared") {
            $price = $adult * $category_tour->adult_price;
            foreach ($ageChild as $age) {
                if ($age > 0 && $age < 3) {
                    $price = $price + $category_tour->infant_price;
                } else if ($age >= 3 && $age < 6) {
                    $price = $price + $category_tour->child_3_5_price;
                } else if ($age >= 6 && $age < 12) {
                    $price = $price + $category_tour->child_6_11_price;
                }
            }

        } else {
            if ($person_number > 0 && $person_number < 5) {
                $price = $price + $category_tour->person_1_4_price;
            } else if ($person_number > 4 && $person_number < 9) {
                $price = $price + $category_tour->person_1_8_price;
            } else if ($person_number > 8 && $person_number < 13) {
                $price = $price + $category_tour->person_1_12_price;
            }
        }
        return $price;
    }

    public function scopePublish($query)
    {

        return $query->where('cancellation_date', '>=', Carbon::today()->startOfDay());
    }
    public function scopeHome($query)
    {

        return $query->where('add_to_home', '1');
    }

    public function period()
    {
        return CarbonPeriod::create($this->date, $this->cancellation_date);
    }

    public function tourTypes()
    {
        return $this->hasMany(ActivityTourType::class, 'activity_tour_id', 'id');
    }

    public function typesId()
    {
        return ActivityTourType::where('activity_tour_id', $this->id)->pluck('activity_type_id')->toArray();
    }

    public function images()
    {
        return $this->hasMany(ActivityTourImage::class, 'activity_tour_id', 'id');
    }
}
