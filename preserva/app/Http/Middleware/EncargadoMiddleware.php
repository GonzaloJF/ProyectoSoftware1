<?php

namespace App\Http\Middleware;

use Closure;

class EncargadoMiddleware
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
            if((Auth::user()->tipo_usuario)==3):
                return $next($request);
            endif;
        endif;

        return (redirect('/'));
    }
}
