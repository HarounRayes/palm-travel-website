<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class CompleteEnquiryScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('complete', 1);
    }
}
