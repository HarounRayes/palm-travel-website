<?php


namespace App\I18n;


use Illuminate\Database\Eloquent\Model;

abstract class LocalizableModel extends Model
{
    /**
     * Localized attributes.
     *
     * @var array
     */
    protected $localizable = [];
    protected $api_locale = null;
    protected $locale = 'ar';


    public function __construct(array $attributes = [])
    {
        if($this->api_locale){
            $this->locale = $this->api_locale;
        } else {
            $this->locale = app()->getLocale();
        }
        parent::__construct($attributes);
    }

    /**
     * Magic method for retrieving a missing attribute.
     *
     * @param string $attribute
     * @return mixed
     */
    public function __get($attribute)
    {
        // We determine the current locale and return the associated
        // locale-specific attribute e.g. name_en
        if (in_array($attribute, $this->localizable)) {
            $localeSpecificAttribute = $attribute . '_' . $this->locale;
            return $this->{$localeSpecificAttribute};
        }
            return parent::__get($attribute);
    }
}
