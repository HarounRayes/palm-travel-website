<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LanguageApi
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('locale')) {
            $locale = $request->header('locale');
        } else {
            $locale = 'ar';
        }
        App::setLocale($locale);
        return $next($request);
    }
}
