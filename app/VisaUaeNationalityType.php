<?php


namespace App;


use App\I18n\LocalizableModel;

class VisaUaeNationalityType extends LocalizableModel
{
    protected $fillable = [
        'visa_uae_nationality_id', 'visa_uae_type_id',
        'adult_price', 'child_price', 'infant_price',
        'processing_time_en', 'processing_time_ar',
        'visa_validity_en', 'visa_validity_ar',
        'stay_validity_en', 'stay_validity_ar',
        'term_and_condition_en', 'term_and_condition_ar',
        'is_default','checkout'
    ];
    protected $localizable = ['processing_time', 'visa_validity', 'stay_validity', 'term_and_condition'];

    public function requirements()
    {
        return $this->hasMany(VisaUaeNationalityTypeRequirement::class, 'visa_uae_nationality_type_id', 'id');
    }

    public function requirements_documents()
    {
        return $this->hasMany(VisaUaeNationalityTypeRequirement::class, 'visa_uae_nationality_type_id', 'id')
            ->whereHas('requirement', function ($q) {
                $q->where('visa_uae_requirements.document', 1);
            });
    }

    public function requirements_contacts()
    {
        return VisaUaeRequirement::where('contact_info', 1)->get();

    }

    public function requirements_main()
    {
        return VisaUaeRequirement::where('contact_info', 0)->where('document', 0)->get();
    }

    public function requirements_ids()
    {
        return $this->hasMany(VisaUaeNationalityTypeRequirement::class, 'visa_uae_nationality_type_id', 'id')->pluck('visa_uae_requirement_id')->toArray();
    }

    public function type()
    {
        return $this->hasOne(VisaUaeType::class, 'id', 'visa_uae_type_id');
    }

    public function nationality()
    {
        return $this->hasOne(VisaUaeNationality::class, 'id', 'visa_uae_nationality_id');
    }
}
