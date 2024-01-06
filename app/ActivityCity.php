<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ActivityCity extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = ['activity_country_id', 'name_en', 'name_ar', 'symbol', 'created_by', 'updated_by'];
    protected $localizable = ['name'];

    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('activities.cities.create.en', 'activities.cities.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($city) {
            $city->tours()->delete();
        });
    }

    public function country()
    {
        return $this->hasOne(ActivityCountry::class, 'id', 'activity_country_id');
    }

    public function tours()
    {
        return $this->hasMany(ActivityTour::class, 'activity_city_id', 'id');
    }
}
