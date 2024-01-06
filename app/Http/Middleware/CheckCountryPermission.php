<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckCountryPermission
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
            'countries.create.en',
            'countries.create.ar',
            'countries.edit.en',
            'countries.edit.ar',
            'countries.delete',

            'cities.create.en',
            'cities.create.ar',
            'cities.edit.en',
            'cities.edit.ar',
            'cities.delete',
            'tours.create.en',
            'tours.create.ar',
            'tours.edit.en',
            'tours.edit.ar',
            'tours.delete',
        ];
        if (Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAnyPermission($permission))
        {
            return $next($request);
        }
        throw UnauthorizedException::forPermissions([$permission]);
    }
}
