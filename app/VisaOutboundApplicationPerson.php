<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaOutboundApplicationPerson extends Model
{
    //
    protected $fillable =['visa_outbound_application_id'];
    public function information()
    {
        return $this->hasMany(VisaOutboundApplicationPersonInformation::class, 'visa_outbound_application_person_id', 'id');
    }

    public function firstName()
    {
        return VisaOutboundApplicationPersonInformation::where('visa_outbound_application_person_id', $this->id)->where('visa_requirement_id', 1)->first();
    }

    public function middleName()
    {
        return VisaOutboundApplicationPersonInformation::where('visa_outbound_application_person_id', $this->id)->where('visa_requirement_id', 2)->first();
    }

    public function lastName()
    {
        return VisaOutboundApplicationPersonInformation::where('visa_outbound_application_person_id', $this->id)->where('visa_requirement_id', 3)->first();
    }
}
