<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityTourType extends Model
{
    use SoftDeletes;

    protected $fillable = ['activity_tour_id', 'activity_type_id'];

    public function tour()
    {
        return $this->hasOne(ActivityTour::class, 'id', 'activity_tour_id');
    }

    public function typ()
    {
        return $this->hasOne(ActivityType::class, 'id', 'activity_type_id');
    }
}
