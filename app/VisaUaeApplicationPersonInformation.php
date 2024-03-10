<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaUaeApplicationPersonInformation extends Model
{
    use SoftDeletes;

    protected $fillable = ['visa_uae_application_person_id', 'visa_uae_requirement_id', 'value'];

    public function requirement()
    {
        return $this->hasOne(VisaUaeRequirement::class, 'id', 'visa_uae_requirement_id');
    }

}
