<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityExclusion extends LocalizableModel
{
    use SoftDeletes;
    protected $fillable=['value_en' ,'value_ar','activity_tour_id'];
    protected $localizable =['value'];
}
