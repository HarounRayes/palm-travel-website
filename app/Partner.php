<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class Partner extends LocalizableModel
{
    protected $fillable = [
        'name_en', 'name_ar', 'image'
    ];
    protected $localizable = ['name'];
}
