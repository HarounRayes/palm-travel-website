<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends LocalizableModel
{
    protected $fillable = ['value_en', 'value_ar', 'title_en', 'title_ar'];
    protected $localizable = ['value', 'title'];

}
