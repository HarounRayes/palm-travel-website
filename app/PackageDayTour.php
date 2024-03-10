<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDayTour extends Model
{
    protected $fillable = ['package_id', 'day_id', 'tour_id'];

    public function tour()
    {
        return $this->hasOne(Tour::class, 'id', 'tour_id');

    }
    public function day()
    {
        return $this->hasOne(Tour::class, 'id', 'day_id');

    }
}
