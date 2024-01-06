<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
   use SoftDeletes;
   protected $fillable = ['blog_id' , 'member_id' ,'commenter_name' ,'comment_text' ,'status'];

   public function member(){
       return $this->hasOne(Member::class,'id','member_id');
   }

    public function blog(){
        return $this->hasOne(Blog::class,'id','blog_id');
    }
}
