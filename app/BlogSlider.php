<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogSlider extends LocalizableModel
{
    use SoftDeletes;

    protected $fillable = ['blog_id', 'text_en', 'text_ar', 'image_en', 'image_ar'];

    public function blog()
    {
        return $this->hasOne(Blog::class, 'id', 'blog_id');
    }

    protected $localizable = [
        'text','image'
    ];
}
