<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageSlider extends LocalizableModel
{
    use SoftDeletes;

    protected $fillable = ['package_id', 'text_en', 'text_ar', 'image_en', 'image_ar'];
    protected $localizable = ['text', 'image'];

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

}
