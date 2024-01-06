<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityType extends LocalizableModel
{
    use SoftDeletes;

    protected $fillable = ['name_en', 'name_ar'];
    protected $localizable = ['name'];
}
