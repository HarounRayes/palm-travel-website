<?php

namespace App;

use App\I18n\LocalizableModel;
use App\Scopes\OrderServicesScope;
use Illuminate\Database\Eloquent\Model;

class Service extends LocalizableModel
{
    protected $fillable = ['icon', 'title_en', 'title_ar', 'text_ar', 'text_en' ,'service_order'];

    protected $localizable = ['title', 'text'];

    protected static function booted()
    {
        parent::boot();
        static::addGlobalScope(new OrderServicesScope());
    }
}
