<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SolicitudMiddleware
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
        if(Auth::check()):
            if(((Auth::user()->tipo_usuario)==1)||((Auth::user()->tipo_usuario)==2)||((Auth::user()->tipo_usuario)==4)):
                return $next($request);
            endif;
        endif;

        return (redirect('/'));
    }
}
