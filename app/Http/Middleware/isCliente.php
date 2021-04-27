<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Api\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

class isCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->tokenCan('can:all-slave') || Auth::user()->tokenCan('can:slave'))
        {
            return $next($request);
        }else{
            return $this->errorResponse('No cuentas con permisos para realizar esta acción.',403);
        }
    }
}
