<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrderServicesScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy('service_order' ,'ASC');
    }
}
