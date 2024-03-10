<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['package_id' , 'member_id','paid' ];
    public $enums = ['paid'];

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }
}
