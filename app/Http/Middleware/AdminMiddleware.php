<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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

        if(Auth::user()->type_id != 1){
            return redirect('/home')->with('error', 'Você não possui acesso a página solicitada!');
        }
        return $next($request);
    }
}
