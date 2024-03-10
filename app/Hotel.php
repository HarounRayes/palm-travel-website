<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

class Hotel extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = ['name_en', 'name_ar', 'info_en', 'info_ar', 'image', 'star_rate', 'symbol', 'website_link', 'country_id'];
    protected $localizable = ['name', 'info'];

    protected static function boot() {
        parent::boot();

        static::deleted(function ($invoice) {
            $invoice->allPackageHotel()->delete();
        });
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('hotels.create.en', 'hotels.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }
    }

    public function allPackageHotel()
    {
        return $this->hasMany(PackageHotel::class, 'hotel_id', 'id');
    }
}
