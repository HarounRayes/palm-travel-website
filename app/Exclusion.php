<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class Exclusion extends LocalizableModel
{
    protected $fillable = ['value_en', 'value_ar', 'package_id'];
    protected $localizable = ['value'];
}
