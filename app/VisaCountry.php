<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class VisaCountry extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'name_en', 'name_ar',
        'image_en', 'image_ar',
        'header_image_en', 'header_image_ar',
        'text_en', 'text_ar',
        'validate_en','validate_ar',
        'flag', 'price', 'add_to_home', 'symbol'
    ];
    protected $localizable = ['name', 'image', 'header_image','text','validate'];

    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('visa.countries.create.en', 'visa.countries.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }
    }

    public function scopeToHome($query)
    {
        return $query->where('add_to_home', '1');
    }

    public function requirements()
    {
        return $this->hasMany(VisaCountryRequirement::class, 'visa_country_id', 'id');
    }

    public function nationalities()
    {
        return $this->hasMany(VisaCountryNationality::class, 'visa_country_id', 'id');
    }

    public function requirementsIDs()
    {
        return VisaCountryRequirement::where('visa_country_id', $this->id)->pluck('visa_requirement_id')->toArray();
    }

    public function nationalitiesIDs()
    {
        return VisaCountryNationality::where('visa_country_id', $this->id)->pluck('visa_nationality_id')->toArray();
    }
}
