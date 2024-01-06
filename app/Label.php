<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends LocalizableModel
{
    protected $fillable = ['value_en', 'value_ar', 'color_en', 'color_ar','package_id'];
    protected $localizable =['value', 'color'];

}
