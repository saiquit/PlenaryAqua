<?php

namespace App\Http\Middleware;

use App\Models\District;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SetDistrictMiddleware
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
        $districts = District::all()->pluck('name_en')->toArray();
        if (!session()->has('district')) {
            // $ip = '103.120.6.174'; //For static IP address get
            // $ip = '37.111.242.153'; //For static IP address get
            $ip = request()->ip();
            $data = \Location::get($ip);
            if (!$data or !in_array($data->cityName, $districts)) {
                session()->put('district', '2');
            } else {
                $district_name = $districts[array_search($data->cityName, $districts)];
                $current_dist = District::where('name_en', $district_name)->first();
                session()->put('district', $current_dist->id);
            }
        }
        return $next($request);
    }
}
