<?php


namespace App;


use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class Type extends LocalizableModel
{
    protected $fillable = ['name_en', 'name_ar'];
    protected $localizable = ['name'];

    public function nationalities()
    {
        return $this->hasMany(VisaUaeNationalityType::class, 'visa_uae_type_id', 'id');
    }
}
