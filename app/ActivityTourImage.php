<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityTourImage extends LocalizableModel
{
    use SoftDeletes;

    protected $fillable = ['name_en', 'name_ar', 'image_path', 'activity_tour_id'];
    protected $localizable = ['name'];
}
