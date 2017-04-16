<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
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
        if(!$request->has('pwd') || $request->pwd != env('API_KEY'))
            return response(json_encode([ "result" => false, "msg" => "unauthorized access" ]));
        return $next($request);
    }
}
