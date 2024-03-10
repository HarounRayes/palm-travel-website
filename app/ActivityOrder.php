<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ActivityOrder extends Model
{
    use SoftDeletes, HasSlug;

    protected $fillable = ['member_id',
        'child', 'adult', 'code',
        'age_child_1', 'age_child_2', 'age_child_3', 'age_child_4', 'age_child_5',
        'email', 'hotel_name', 'country_code', 'mobile', 'is_paid', 'active'];

        public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model) {
                return 'activity-' . Carbon::now()->timestamp;
            })
            ->saveSlugsTo('code');
    }

    public function book()
    {
        return $this->hasOne(ActivityBook::class, 'activity_order_id', 'id');
    }

    public function card()
    {
        return $this->hasMany(ActivityCard::class, 'activity_order_id', 'id');
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    public function number_of_person()
    {
        $number = 0;
        foreach ($this->card as $card) {
            $number += $card->adult + $card->child;
        }
        return $number;
    }

    public function total_price()
    {
        $number = 0;
        foreach ($this->card as $card) {
            $number += $card->price;
        }
        return $number;
    }

    public function transaction()
    {
        return $this->hasOne(ActivityTransaction::class, 'activity_order_id', 'id');
    }
}
