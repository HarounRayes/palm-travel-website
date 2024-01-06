<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityBook extends Model
{
    use SoftDeletes;

    protected $table = 'activity_book';
    protected $fillable = ['activity_order_id', 'member_id', 'total_price'];
}
