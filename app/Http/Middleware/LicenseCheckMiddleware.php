<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LicenseCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $dates = DB::table('license')->first();

        if (isset($dates->from_date) && isset($dates->to_date)) {
            date_default_timezone_set('Asia/Kolkata');
            $today = date("Y-m-d");

            if ($today > $dates->to_date) {
                $response = response()->view('expired', [], 200);
                return $response;
            }
        }

        return $next($request);
    }
}
