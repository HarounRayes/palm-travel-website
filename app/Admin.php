<?php

namespace App;

use App\Scopes\SuperadminAdminScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable,HasRoles;
    protected $guard = 'admin';

    protected static function booted()
    {
        static::addGlobalScope(new SuperadminAdminScope());
    }
    protected $fillable = [
        'name', 'email', 'password','username',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
