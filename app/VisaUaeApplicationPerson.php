<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaUaeApplicationPerson extends Model
{
    //
    protected $fillable = ['visa_uae_application_id'];

    public function information()
    {
        return $this->hasMany(VisaUaeApplicationPersonInformation::class, 'visa_uae_application_person_id', 'id');
    }

    public function firstName()
    {
        return VisaUaeApplicationPersonInformation::where('visa_uae_application_person_id', $this->id)->where('visa_uae_requirement_id', 1)->first();
    }

    public function middleName()
    {
        return VisaUaeApplicationPersonInformation::where('visa_uae_application_person_id', $this->id)->where('visa_uae_requirement_id', 2)->first();
    }

    public function lastName()
    {
        return VisaUaeApplicationPersonInformation::where('visa_uae_application_person_id', $this->id)->where('visa_uae_requirement_id', 3)->first();
    }

    public function value($requirement)
    {
        $VisaUaeApplicationPersonInformation = VisaUaeApplicationPersonInformation::where('visa_uae_requirement_id', $requirement)->where('visa_uae_application_person_id', $this->id)->first();
        if ($VisaUaeApplicationPersonInformation)
            return $VisaUaeApplicationPersonInformation->value;
        else
            return '';
    }

    public function emails()
    {
        return VisaUaeApplicationPersonInformation::where('visa_uae_application_person_id', $this->id)->where('visa_uae_requirement_id', 14)->get();
    }

    public function mobiles()
    {
        return VisaUaeApplicationPersonInformation::where('visa_uae_application_person_id', $this->id)->where('visa_uae_requirement_id', 13)->get();
    }

    public function codes()
    {
        return VisaUaeApplicationPersonInformation::where('visa_uae_application_person_id', $this->id)->where('visa_uae_requirement_id', 12)->get();
    }


}
