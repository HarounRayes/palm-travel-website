<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class City extends Model
{
    use SoftDeletes;
    use HasSlug;
    protected $fillable = ['name_en' ,'name_ar' ,'description_en','description_ar','country_id' ,'symbol' ];

    public function country(){
        return $this->hasOne(Country::class, 'id' , 'country_id');
    }
    public function getSlugOptions() : SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('cities.create.en','cities.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }
    }
    protected static function booted()
    {
        parent::boot();

        static::deleted(function ($country) {
            $country->packages()->delete();
            $country->tours()->delete();
        });
    }
    public function tours()
    {
        return $this->hasMany(Tour::class, 'city_id', 'id');
    }
    public function packages()
    {
        return $this->hasMany(Package::class, 'city', 'id');

    }
}
