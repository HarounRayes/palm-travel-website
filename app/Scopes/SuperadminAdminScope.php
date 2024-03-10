<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class SuperadminAdminScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
    //   if(Auth::guard('admin')->check() && !Auth::guard('admin')->user()->hasRole('super-admin'))
    //     {
    //         $builder->where('id' ,'!=', '1');            
    //     }

    }
}
