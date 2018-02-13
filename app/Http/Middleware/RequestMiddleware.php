<?php

namespace App\Http\Middleware;

use Closure;

class RequestMiddleware
{
    protected $except = [
        'catchup/*/*',
        'live/*/*',
        'video/*/*',
        'radio/*/*',
        'radio/show/*/*/*',
        'live/',
        'WeKnow/',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && !$this->shouldPassThrough($request)) {
            return redirect()->to($request->getRequestUri(), 302, [], true); //$request->getRequestUri()
        }else{
            if($request->secure() && $this->shouldPassThrough($request))
            return redirect()->to($request->getRequestUri(), 302, [], false); //$request->getRequestUri()
        }

        return $next($request);
    }

    protected function shouldPassThrough($request)
    {
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
