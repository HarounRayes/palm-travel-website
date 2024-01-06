<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaUaeCountryRequirement extends Model
{

    protected $fillable = ['visa_requirement_id'];

    public function requirement()
    {
        return $this->hasOne(VisaRequirement::class, 'id', 'visa_requirement_id');
    }

}
