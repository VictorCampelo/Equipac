<?php

namespace equipac\Http\Middleware;

use Closure;

class usuario
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
        if(auth()->user()->nivel == 2){
            return $next($request);
        }
        return redirect(‘login’)->with(‘error’,’You have not admin access’);

    }
