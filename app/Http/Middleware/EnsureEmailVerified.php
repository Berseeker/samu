<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
                if(stristr($request->getPathInfo(), 'api')){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Necesita verificar su email para acceder a esta ruta',
                        'data' => NULL,
                        'code' => 401
                    ],401);
                }else{
                    return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
                }
        }
        return $next($request);
    }
}
