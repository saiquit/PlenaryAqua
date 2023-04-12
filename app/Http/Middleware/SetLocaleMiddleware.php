<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('locale')) {
            Session::put('locale', Config::get('app.fallback_locale'));
        } else if (in_array($request->query('lang'), Config::get('app.available_locales'))) {
            App::setLocale($request->query('lang'));
            Session::put('locale', $request->query('lang'));
            return $next($request);
        } else {
            App::setLocale(session('locale'));
            return $next($request);
        }
        // dd($request);
        return $next($request);
    }
}
