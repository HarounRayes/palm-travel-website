<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class Page extends LocalizableModel
{
    protected $fillable = ['title_en', 'title_ar', 'text_en', 'text_ar', 'header_image_en', 'header_image_ar'];
    protected $localizable = ['title', 'text', 'header_image'];

}
