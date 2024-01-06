<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckEditPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$counroller)
    {
        $permission = [
            $counroller.'.edit.en',
            $counroller.'.edit.ar'
        ];
        if (Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAnyPermission($permission))
        {
            return $next($request);
        }
        throw UnauthorizedException::forPermissions([$permission]);
    }
}
