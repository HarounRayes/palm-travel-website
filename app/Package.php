<?php

namespace App;

use App\I18n\LocalizableModel;
use App\Scopes\AdminModelActiveScope;
use App\Scopes\AdminModelBetweenDatesScope;
use App\Scopes\AdminModelDraftScope;
use App\Scopes\PackageHasHotel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Package extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = ['publish', 'publish_date', 'suppress_date', 'passenger_details', 'flight', 'country',
        'city', 'hotels', 'transfer', 'activity', 'video', 'map', 'date', 'number', 'open_include',
        'open_not_include', 'open_term', 'open_cancellation', 'open_additional_info', 'symbol', 'name_ar',
        'name_en', 'region_en', 'region_ar',
        'overview_en', 'overview_ar', 'terms_condition_en', 'terms_condition_ar', 'cancellation_policy_en',
        'cancellation_policy_ar', 'additional_info_en', 'additional_info_ar', 'pdf_en', 'pdf_ar',
        'package_image_header_en', 'package_image_header_ar', 'image_en', 'image_ar', 'package_order', 'status', 'draft',
        'created_by', 'updated_by', 'used', 'is_featured'
    ];
    protected $localizable = [
        'name', 'destination', 'region', 'category',
        'overview', 'terms_condition', 'cancellation_policy', 'additional_info', 'pdf',
        'package_image_header', 'image'
    ];

    public $enums = ['flight', 'hotels', 'transfer', 'activity', 'active', 'open_include', 'open_not_include',
        'open_term', 'open_cancellation', 'open_additional_info', 'expaired', 'status', 'draft', 'is_featured'];

    protected static function booted()
    {
//        static::addGlobalScope(new AdminModelActiveScope());
//        static::addGlobalScope(new AdminModelBetweenDatesScope());
//        static::addGlobalScope(new AdminModelDraftScope());

        parent::boot();

        static::deleted(function ($tour) {
            $tour->labels()->delete();
            $tour->inclusions()->delete();
            $tour->exclusions()->delete();
            $tour->days()->delete();
            $tour->sliders()->delete();
            $tour->transfers()->delete();
            $tour->flights()->delete();
            $tour->packageHotels()->delete();
            $tour->types()->delete();
            $tour->offers()->delete();
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->hasAnyPermission('packages.create.en', 'packages.edit.en')) {
                return SlugOptions::create()
                    ->generateSlugsFrom('name_en')
                    ->saveSlugsTo('symbol');
            } else {
                return SlugOptions::create()
                    ->generateSlugsFrom('name_ar')
                    ->saveSlugsTo('symbol');
            }
        } else {

            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        }

    }

    public function scopeActive($query)
    {

        return $query->where('status', '1');
    }

    public function scopeNotDraft($query)
    {

        return $query->where('draft', '0');
    }

    public function scopePublish($query)
    {

        return $query->where('publish_date', '<=', Carbon::today()->startOfDay())
            ->where('suppress_date', '>=', Carbon::today()->startOfDay());
    }

    public function labels()
    {
        return $this->hasMany(Label::class, 'package_id', 'id');
    }

    public function inclusions()
    {
        return $this->hasMany(Inclusion::class, 'package_id', 'id');
    }

    public function exclusions()
    {
        return $this->hasMany(Exclusion::class, 'package_id', 'id');
    }

    public function days()
    {
        return $this->hasMany(Day::class, 'package_id', 'id');
    }

    public function sliders()
    {
        return $this->hasMany(PackageSlider::class, 'package_id', 'id');
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class, 'package_id', 'id');
    }

    public function flights()
    {
        return $this->hasMany(Flight::class, 'package_id', 'id');
    }

    public function packageHotels()
    {
        return $this->hasMany(PackageHotel::class, 'package_id', 'id');
    }

    public function packageCountry()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    public function packageCity()
    {
        return $this->hasOne(City::class, 'id', 'city');
    }

    public function types()
    {
        return $this->hasMany(PackageType::class, 'package_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany(PackageOffer::class, 'package_id', 'id');
    }

    public function typesId()
    {
        return PackageType::where('package_id', $this->id)->pluck('type_id')->toArray();
    }

    public function offersId()
    {
        return PackageOffer::where('package_id', $this->id)->pluck('offer_id')->toArray();
    }

    public function checkDisableShowPackage()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->publish_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->suppress_date);

        if (Carbon::now()->lessThanOrEqualTo($startDate)) {
            return true;
        }

        return Carbon::now()->between($startDate, $endDate);
    }

    public function defaultHotel()
    {
        $hotel = PackageHotel::leftJoin('hotels', 'package_hotels.hotel_id', '=', 'hotels.id')->where('package_hotels.package_id', $this->id)->orderBy('hotels.star_rate', 'ASC')->first();
        return $hotel;
    }

    public function checkBookablePackage()
    {

        if ($this->number == 0)
            return false;

        if ($this->used >= $this->number)
            return false;

        return true;
    }

}
