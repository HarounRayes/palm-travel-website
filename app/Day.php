<?php

namespace App;

use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;

class Day extends LocalizableModel
{
    protected $fillable = ['package_id', 'day_title_en', 'day_title_ar', 'day_description_en', 'day_description_ar', 'open_day'];

    protected $localizable = ['day_title', 'day_description'];

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($invoice) {
            $invoice->PackageDayTour()->delete();
        });
    }

    public function PackageDayTour()
    {
        return $this->hasMany(PackageDayTour::class, 'day_id', 'id');
    }

    public function daytours()
    {
        return $this->hasMany(PackageDayTour::class, 'day_id', 'id')->where('package_id', $this->package_id);

    }
    public function dayToursByPackage(){
        return PackageDayTour::where('package_id',$this->package_id)->where('day_id' , $this->id)->get();
    }

}
