<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaOutboundNationality extends Model
{
    protected $fillable = ['visa_country_id' , 'visa_nationality_id' ,'visa_outbound_id' ,'price'];

    public function country(){
        return $this->hasOne(VisaCountry::class,'id','visa_country_id');
    }
    public function nationality(){
        return $this->hasOne(VisaNationality::class,'id','visa_nationality_id');
    }
}
