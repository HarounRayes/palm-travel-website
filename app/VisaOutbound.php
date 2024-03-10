<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\I18n\LocalizableModel;


class VisaOutbound extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;
    protected $fillable = [
        'visa_type_id' ,'visa_country_id',
        'name_en' ,'name_ar' ,
        'intro_en','intro_ar',
        'text_en' ,'text_ar' ,
        'note_en', 'note_ar' ,
        'image_en' , 'image_ar',
        'header_image_en' ,'header_image_ar',
        'created_by' ,'updated_by',
        'symbol'
    ];
     protected $localizable = ['name', 'intro', 'text', 'note','image','header_image'];

    public function getSlugOptions() : SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('visa.outbounds.create.en','visa.outbounds.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }
    }

    public function country(){
        return $this->hasOne(VisaCountry::class,'id' ,'visa_country_id');
    }
    public function type(){
        return $this->hasOne(VisaType::class,'id','visa_type_id');
    }
    public function nationalities(){
        return $this->hasMany(VisaOutboundNationality::class,'visa_outbound_id' ,'id');
    }
    public function nationalitiesIDs(){
        return VisaOutboundNationality::where('visa_outbound_id' ,$this->id)->pluck('visa_nationality_id')->toArray();
    }
    public function requirements()
    {
        return VisaCountryRequirement::where('visa_country_id' , $this->visa_country_id)->get();
    }
}
