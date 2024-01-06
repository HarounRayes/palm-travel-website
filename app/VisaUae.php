<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class VisaUae extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'visa_type_id', 'symbol',
        'name_en', 'name_ar',
        'intro_en', 'intro_ar',
        'text_en', 'text_ar',
        'note_en', 'note_ar',
        'image_en', 'image_ar',
        'header_image_en', 'header_image_ar',
        'created_by', 'updated_by'
    ];
    protected $localizable = ['name', 'intro', 'text', 'note', 'image'];

    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('visa.uae.create.en', 'visa.uae.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }
    }

    public function type()
    {
        return $this->hasOne(VisaType::class, 'id', 'visa_type_id');
    }

    public function nationalities()
    {
        return $this->hasMany(VisaUaeNationality::class, 'visa_uae_id', 'id');
    }

    public function nationalitiesIDs()
    {
        return VisaUaeNationality::where('visa_uae_id', $this->id)->pluck('visa_nationality_id')->toArray();
    }

    public function nationalityPrice($nationality_id)
    {
        $uaeNationality = VisaUaeNationality::where('visa_nationality_id', $nationality_id)->where('visa_uae_id', $this->id)->first();
        if ($uaeNationality)
            return $uaeNationality->price;
        else
            return "";
    }

    public function inclusions()
    {
        return $this->hasMany(VisaUaeInclusion::class, 'visa_uae_id', 'id');
    }

    public function exclusions()
    {
        return $this->hasMany(VisaUaeExclusion::class, 'visa_uae_id', 'id');
    }

    public function requirements()
    {
        return VisaUaeCountryRequirement::all();
    }
}
