<?php

namespace App\Exceptions;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Request;
use Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
     HttpException::class,
        ModelNotFoundException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        Log::info($e->getMessage(), [
            'url' => Request::url(),
            'input' => Request::all()
        ]);

        //Send email for errors.
        try{
            if ($e instanceof \Exception) {
                // emails.exception is the template of your email
                // it will have access to the $error that we are passing below
                $emails = ['mohamadn@dotcomlb.com', 'hany@dotcomlb.com'];
                Mail::raw($e->getMessage(), function ($m) use($emails) {
                    $m->to($emails)->subject('your email subject');
                });
            }
        }catch (Exception $ex){

        }
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
         $data = ['errormessage' => $e->getMessage(),
            'filerror' => $e->getFile(),
            'linerror' => $e->getLine(),
            'tracerror' => $e->getPrevious()
        ];
        $headers = "From: 'bugs@awaan.com' <info@dotcomlb.com>\r\n";
        $headers .= 'Cc: tony@dotcomlb.com' . "\r\n";
        $message = ' Error message:' . $e->getMessage() . '\n File :' . $e->getFile() . '\n Line :' . $e->getLine();
       //mail('hany@dotcomlb.com', 'Error Exception on awaan', $message, $headers);

        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        return parent::render($request, $e);
    }
}
