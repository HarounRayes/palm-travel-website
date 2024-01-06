<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaCountryRequirement extends Model
{

    protected $fillable = [ 'visa_country_id','visa_requirement_id'];

    public function requirement()
    {
        return $this->hasOne(VisaRequirement::class, 'id', 'visa_requirement_id');
    }
}
