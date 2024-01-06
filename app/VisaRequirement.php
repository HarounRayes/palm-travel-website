<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class VisaRequirement extends LocalizableModel
{
    protected $fillable = [ 'field', 'name_en', 'name_ar', 'type', 'contact_info', 'document' ];

    protected $localizable = ['name'];
}
