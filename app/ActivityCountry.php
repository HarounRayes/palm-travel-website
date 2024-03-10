<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ActivityCountry extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = ['name_en', 'name_ar', 'symbol', 'created_by', 'updated_by'];
    protected $localizable = ['name'];

    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('activities.countries.create.en', 'activities.countries.edit.en')) {
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

        static::deleted(function ($country) {
            $country->cities()->delete();
            $country->tours()->delete();
        });
    }

    public function cities()
    {
        return $this->hasMany(ActivityCity::class, 'activity_country_id', 'id');
    }
    public function tours(){
        return $this->hasMany(ActivityTour::class,'activity_country_id' ,'id');
    }
}
