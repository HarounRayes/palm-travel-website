<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaOutboundApplication extends Model
{
    use SoftDeletes;

    protected $fillable = ['visa_nationality_id', 'visa_outbound_id', 'person_number', 'price', 'note', 'reference_id', 'is_enquiry', 'is_proceed', 'member_id', 'visa_country_id'];

    public function people()
    {
        return $this->hasMany(VisaOutboundApplicationPerson::class, 'visa_outbound_application_id', 'id');
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    public function visa()
    {
        return $this->hasOne(VisaOutbound::class, 'id', 'visa_outbound_id');
    }
    public function nationality()
    {
        return $this->hasOne(VisaNationality::class, 'id', 'visa_nationality_id');
    }
}
