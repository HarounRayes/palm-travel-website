<?php

namespace App;

use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Member extends Authenticatable
{
    use Notifiable;

    protected $guard = 'member';

    protected $fillable = [
        'name', 'email', 'password','phone','provider','provider_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function favorites(){
        return $this->hasMany(Favorite::class ,'member_id' , 'id');
    }
    public function favorites_ids(){
        return $this->hasMany(Favorite::class ,'member_id' , 'id')->pluck('package_id')->toArray();
    }
    public function orderActivity(){
        return $this->hasOne(ActivityOrder::class,'member_id','id')->whereDoesntHave('book');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token, $this));
    }
}
