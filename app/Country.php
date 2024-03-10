<?php

namespace App;

use App\I18n\LocalizableModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Country extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'name_en', 'name_ar',
        'capital_en', 'capital_ar',
        'currency_en', 'currency_ar',
        'convert_currency_en', 'convert_currency_ar',
        'official_lang_en', 'official_lang_ar',
        'visa_info_en', 'visa_info_ar',
        'image_en', 'image_ar',
        'header_image_en', 'header_image_ar',
        'background_image_en', 'background_image_ar',
        'intro_en', 'intro_ar',
        'flag', 'start_price', 'color_label',
        'symbol', 'country_order','add_to_home',
        'background_image'
    ];

    protected $localizable = [
        'name', 'capital',
        'currency',
        'convert_currency',
        'official_lang',
        'visa_info',
        'image',
        'header_image',
        'intro',
        'background_image'
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleted(function ($country) {
            $country->cities()->delete();
            $country->tours()->delete();
            $country->hotels()->delete();
            $country->packages()->delete();
        });
    }
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    public function tours()
    {
        return $this->hasMany(Tour::class, 'country_id', 'id');
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'country_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('countries.create.en','countries.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }

    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'country', 'id');

    }

    public function hotelPackageMinPrice()
    {
        return PackageHotel::leftJoin('packages', 'package_hotels.package_id', '=', 'packages.id')->where('packages.country', $this->id)->min('package_hotels.price');
    }

    public function hotelPackageMaxPrice()
    {
        return PackageHotel::leftJoin('packages', 'package_hotels.package_id', '=', 'packages.id')->where('packages.country', $this->id)->max('package_hotels.price');
    }
    public function packagesHome()
    {
        return $this->hasMany(Package::class, 'country', 'id')->Active()->NotDraft()->Publish()->whereHas('packageHotels');

    }
}
