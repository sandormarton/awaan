<?php

namespace App\Http\Middleware;

use Closure;

class RequestMiddleware
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

        if(!$request->is('auth/login') && $request->secure()){
            return redirect()->to($request->getRequestUri(), 302, [], false); //$request->getRequestUri()
        }

        return $next($request);
    }
}
