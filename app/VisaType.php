<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\I18n\LocalizableModel;

class VisaType extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;
    protected $fillable = [
        'name_en' ,'name_ar' ,
        'image_en' , 'image_ar',
        'header_image_en' ,'header_image_ar',
        'intro_en','intro_ar',
        'created_by', 'updated_by',
        'add_to_home' ,'symbol'
    ];

 protected $localizable = ['name', 'image', 'intro', 'header_image'];

    public function getSlugOptions() : SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('visa.types.create.en','visa.types.edit.en')) {
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
}
