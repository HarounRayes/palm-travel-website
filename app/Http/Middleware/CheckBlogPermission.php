<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckBlogPermission
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
            'blogs.create.en',
            'blogs.create.ar',
            'blogs.edit.en',
            'blogs.edit.ar',
            'blogs.delete',
            'blogs.comment',
            'blogs.slider',
        ];
        if (Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAnyPermission($permission))
        {
            return $next($request);
        }
        throw UnauthorizedException::forPermissions([$permission]);

    }
}
