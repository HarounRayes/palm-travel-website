<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaUaeExclusion extends LocalizableModel
{
    use SoftDeletes;
    protected $fillable=['value_en' ,'value_ar','visa_uae_id'];
    protected $localizable =['value'];
}
