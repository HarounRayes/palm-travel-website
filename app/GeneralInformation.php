<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class GeneralInformation extends LocalizableModel
{
    protected $table = 'general_informations';
    protected $fillable = [
        'intro_en', 'intro_ar',
        'header_image_en', 'header_image_ar',
        'title_section_1_en','title_section_1_ar',
        'title_section_2_en','title_section_2_ar',
        'is_image'
    ];

    protected $localizable =[
      'intro' , 'header_image','title_section_1','title_section_2'
    ];
}
