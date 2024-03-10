<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaUaeNationalityTypeRequirement extends Model
{
    protected $fillable = ['visa_uae_nationality_id','visa_uae_type_id','visa_uae_requirement_id','visa_uae_nationality_type_id'];

    public function requirement(){
        return $this->hasOne(VisaUaeRequirement::class,'id','visa_uae_requirement_id');
    }
}
