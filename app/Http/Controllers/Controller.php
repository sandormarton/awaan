<?php

namespace App\Http\Controllers;

use App\Providers\ApiRequest;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \App\Http\Middleware\Language;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use \View;

abstract class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;
    protected $layout = 'layouts.master';

    public function __construct(Route $route)
    {

    }

    protected function template($content) {
        return view($this->layout, ['content' => $content]);
    }

}