<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityCard extends Model
{
    use SoftDeletes;

    protected $table = 'activity_card';
    protected $fillable = [
        'activity_tour_category_id', 'activity_tour_id', 'activity_category_id', 'member_id', 'activity_order_id',
        'date', 'price', 'adult', 'child', 'age_child_1', 'age_child_2', 'age_child_3', 'age_child_4','age_child_5',
    'email','drop_off','pick_up','country_code','mobile'];

    public function activity()
    {
        return $this->hasOne(ActivityTour::class, 'id', 'activity_tour_id');
    }

    public function category()
    {
        return $this->hasOne(ActivityCategory::class, 'id', 'activity_category_id');
    }

    public function tourCategory()
    {
        return $this->hasOne(ActivityTourCategory::class, 'id', 'activity_tour_category_id');
    }

    public function order()
    {
        return $this->hasOne(ActivityOrder::class, 'id', 'activity_order_id');
    }
    public function orderNotBook()
    {
        return $this->hasOne(ActivityOrder::class, 'id', 'activity_order_id')->whereDoesntHave('book');
    }
    public function people(){
        return $this->hasMany(ActivityOrderPerson::class,'activity_card_id','id');
    }
    public function number_of_person(){
       return ($this->adult + $this->child);

    }
}
