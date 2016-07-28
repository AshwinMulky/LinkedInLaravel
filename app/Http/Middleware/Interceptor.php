<?php

namespace App\Http\Middleware;

use Log;

use Closure;

class Interceptor
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

        //Do logging

        Log::info('We got a hit : '.$request);

        return $next($request);
    }
}
