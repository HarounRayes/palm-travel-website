<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTour extends Model
{
    use SoftDeletes;

    protected $fillable = ['tour_id', 'member_id', 'day_id',
        'adult_number', 'child_number','child_number_2', 'child_age_1', 'child_age_2', 'tour_cost', 'number_day', 'type', 'session_id'
    ];
    protected $enums = ['type'];

    public function day()
    {
        return $this->hasOne(Day::class, 'id', 'day_id');
    }

    public function tour()
    {
        return $this->hasOne(Tour::class, 'id', 'tour_id');
    }
}
