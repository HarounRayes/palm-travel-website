<?php


namespace App\Scopes;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class AdminModelBetweenDatesScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        if(!Auth::guard('admin')->check())
        {
            $builder->where('publish_date', '<=', Carbon::today()->startOfDay())
                ->where('suppress_date', '>=', Carbon::today()->startOfDay());
        }
    }
}
