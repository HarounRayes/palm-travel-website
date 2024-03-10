<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasPermissionTo(array $permissions)
    {
        if (Auth::guard('admin')->user()->hasRole('super-admin'))
            return true;

        return Auth::guard('admin')->user()->hasPermissionTo($permissions);

    }

    public function hasAllPermissions(array $permissions)
    {
        if (Auth::guard('admin')->user()->hasRole('super-admin'))
            return true;

        return Auth::guard('admin')->user()->hasAllPermissions($permissions);
    }

    public function hasAnyPermission(array $permissions)
    {
        if (Auth::guard('admin')->user()->hasRole('super-admin'))
            return true;

        return Auth::guard('admin')->user()->hasAnyPermission($permissions);
    }
}
