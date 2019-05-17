<?php

namespace equipac\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
 /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
    
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
               return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('usuario') || $request->is('usuario/*')) {
            $login = 'usuarios.auth.login';
            return redirect()->guest(route($login));
        }
        if ($request->is('bolsista') || $request->is('bolsista/*')) {
            $login = 'bolsista.auth.login';
             return redirect()->guest(route($login));
        }
        if ($request->is('supervisor') || $request->is('supervisor/*')) {
            $login = 'supervisor.auth.login';
             return redirect()->guest(route($login));
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            $login = 'admin.auth.login';
             return redirect()->guest(route($login));
        }
            return redirect()->guest(route('login'));
    }
}
