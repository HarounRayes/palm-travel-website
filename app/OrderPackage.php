<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPackage extends Model
{
  use SoftDeletes;
  protected $fillable =['package_id' ,'member_id' ,'paid'];
  protected $enums = ['paid'];
}
