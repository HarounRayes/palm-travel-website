<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class VisaUaeApplication extends Model
{
    use SoftDeletes;

    protected $fillable = ['visa_uae_nationality_id', 'visa_uae_type_id', 'visa_uae_nationality_type_id', 'person_number', 'price',
        'note', 'reference_id', 'is_enquiry', 'is_proceed', 'member_id',
        'adult', 'child', 'infant', 'is_paid', 'code','active'
    ];

    public function people()
    {
        return $this->hasMany(VisaUaeApplicationPerson::class, 'visa_uae_application_id', 'id');
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    public function visa()
    {
        return $this->hasOne(VisaUaeNationalityType::class, 'id', 'visa_uae_nationality_type_id');
    }

    public function nationality()
    {
        return $this->hasOne(VisaUaeNationality::class, 'id', 'visa_uae_nationality_id');
    }

    public function type()
    {
        return $this->hasOne(VisaUaeType::class, 'id', 'visa_uae_type_id');
    }

    public function transaction()
    {
        return $this->hasOne(VisaUaeTransaction::class, 'application_id', 'id');
    }
}
