<?php

namespace App;

use App\Scopes\OrderDocumentScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\I18n\LocalizableModel;

class VisaUaeRequirement extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'name_en', 'name_ar',
        'document', 'requirement_order', 'contact_info', 'required',
        'type', 'field'
    ];

    protected $localizable = ['name'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function () {
                return "document";
            })
            ->saveSlugsTo('field');
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderDocumentScope());
    }

    public function scopeContact($q)
    {
        return $q->where('contact_info', 1);
    }

    public function scopeDocument($q)
    {
        return $q->where('document', 1);
    }

    public function scopeMainInfo($q)
    {
        return $q->where('document', 0)->where('contact_info',0);
    }
}
