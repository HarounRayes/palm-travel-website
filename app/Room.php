<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
  use SoftDeletes;
  protected $fillable = [
      'enquiry_id','member_id','book_id',
      'num_adult','num_child','age_child_1' ,'age_child_2','room_cost'
      ];

}
