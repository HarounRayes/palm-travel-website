<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckActivitiesCountriesPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permission = [
            'activities.countries.create.en',
            'activities.countries.create.ar',
            'activities.countries.edit.en',
            'activities.countries.edit.ar',
            'activities.countries.delete',
            'activities.cities.create.en',
            'activities.cities.create.ar',
            'activities.cities.edit.en',
            'activities.cities.edit.ar',
            'activities.cities.delete',
        ];
        if (Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAnyPermission($permission))
        {
            return $next($request);
        }
        throw UnauthorizedException::forPermissions([$permission]);

    }
}
