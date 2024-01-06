<?php


namespace App;


use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class Offer extends LocalizableModel
{
    protected $fillable = ['name_en' , 'name_ar'];
    protected $localizable = ['name'];
}
