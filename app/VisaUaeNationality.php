<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class VisaUaeNationality extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'name_en', 'name_ar',
        'text_en', 'text_ar',
        'image_en', 'image_ar',
        'header_image_en' ,'header_image_ar',
        'symbol', 'is_visa', 'add_to_home',
        'created_by', 'updated_by'
    ];
    protected $localizable = ['name', 'text', 'image','header_image'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_en')
            ->saveSlugsTo('symbol');
    }

    public function types()
    {
        return $this->hasMany(VisaUaeNationalityType::class, 'visa_uae_nationality_id', 'id');
    }

    public function allTypes()
    {
       return Type::whereHas('nationalities', function($query){
            $query->where('visa_uae_nationality_types.visa_uae_nationality_id', $this->id);
        })->get();
    }

    public function types_ids()
    {
        return VisaUaeNationalityType::where('visa_uae_nationality_id', $this->id)->pluck('visa_uae_type_id')->toArray();
    }

    public function scopeHome($query)
    {

        return $query->where('add_to_home', '1');
    }

    public function defaultType()
    {
        return VisaUaeNationalityType::where('visa_uae_nationality_id', $this->id)->where('is_default', 1)->first();
    }
}
