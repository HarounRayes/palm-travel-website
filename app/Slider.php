<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends LocalizableModel
{
    use SoftDeletes;

    protected $fillable = ['text_en', 'text_ar', 'link_en', 'link_ar', 'image_en', 'image_ar'];
    protected $localizable = ['text', 'link', 'image'];

}
