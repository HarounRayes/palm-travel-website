<?php

namespace App\Http\Middleware;

use App\ActivityType;
use App\Blog;
use App\GlobalModel;
use App\SiteSetting;
use Closure;
use Illuminate\Support\Facades\View;
use Session;
use App;
use Config;
class LanguageSwitcher
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
        if (!Session::has('locale'))
        {
            Session::put('locale',Config::get('app.locale'));
        }

        App::setLocale(session('locale'));
        $site_settings = SiteSetting::pluck('value_' . app()->getLocale(), 'name')->all();
        \Illuminate\Support\Facades\Config::set('site_settings', $site_settings);

        $intro = SiteSetting::where('name', 'intro')->first();
        \Illuminate\Support\Facades\Config::set('intro_title', $intro->title);
        \Illuminate\Support\Facades\Config::set('intro_value', $intro->value);

        $global_models = GlobalModel::pluck('status', 'name')->all();
        \Illuminate\Support\Facades\Config::set('global_models', $global_models);

        $blogs = Blog::orderBy('id', 'DESC')->first();

        View::share(['blogs' => $blogs]);

        return $next($request);
    }
}
