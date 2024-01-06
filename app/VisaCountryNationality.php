<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaCountryNationality extends Model
{

    protected $fillable = ['visa_country_id', 'visa_nationality_id'];

    public function nationality()
    {
        return $this->hasOne(VisaNationality::class, 'id', 'visa_nationality_id');

    }
}
