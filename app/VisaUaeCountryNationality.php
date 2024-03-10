<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaUaeCountryNationality extends Model
{
 protected $fillable = ['visa_nationality_id'];
    public function nationality()
    {
        return $this->hasOne(VisaNationality::class, 'id', 'visa_nationality_id');

    }
}
