<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaOutboundApplicationPersonInformation extends Model
{
    use SoftDeletes;

    protected $fillable = ['visa_outbound_application_person_id', 'visa_requirement_id', 'value'];
}
