<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class Language {

    public function __construct(Application $app, Redirector $redirector, Request $request) {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $locale = 'ar';


       if($request->getSession()->has('lang')){
           $locale = $request->getSession()->get('lang');
       }

//        $request->session()->forget('lang'); //reset
        $locales = Config('app.locales');

        if (array_key_exists($locale, $locales)) {
            $request->session()->set('lang', $locale);
            app()->setLocale($locale);
        } else {
            $locale = null;
            $request->session()->set('lang', Config('app.fallback_locale'));
            app()->setLocale(Config('app.fallback_locale'));
        }

        return $next($request);
    }

}