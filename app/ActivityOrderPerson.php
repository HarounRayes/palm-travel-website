<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityOrderPerson extends Model
{
    use SoftDeletes;
    protected $table = 'activity_order_persons';
    protected $fillable=['member_id' ,'activity_order_id','first_name','last_name','is_main','activity_card_id'];
}
