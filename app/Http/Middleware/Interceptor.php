<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;

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

        //Log::info('We got a hit : '.$request);

       // echo "hello";

        return $next($request);
    }
}
