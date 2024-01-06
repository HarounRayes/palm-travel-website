<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\I18n\LocalizableModel;

class VisaUaeType extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'name_en', 'name_ar',
        'image_en' , 'image_ar',
        'created_by', 'updated_by',
        'symbol','add_to_home'
    ];

    protected $localizable = ['name','image', 'header_image'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_en')
            ->saveSlugsTo('symbol');

    }
    public function scopeHome($query)
    {

        return $query->where('add_to_home', '1');
    }
}
