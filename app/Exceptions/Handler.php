<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;
use Throwable;
use App;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {   
        //dd($request->getPathInfo());
        if(stristr($request->getPathInfo(), 'api')){
            if($exception instanceof ValidationException){
                return response()->json(['message'=>$exception->getMessage(),'error'=>$exception->errors(),'code'=>$exception->status],$exception->status);
            }
            if($exception instanceof ModelNotFoundException){
                $modelo = class_basename($exception->getModel());
                return response()->json(['message'=>'error','error'=>'No existe ninguna instancia de '.$modelo.' con el id solicitado','code'=>404],404);
            }
            if($exception instanceof AuthenticationException){
                return response()->json(['message'=>'error','error'=>'Usuario no autenticado','code'=>401],401);
            }
            if($exception instanceof AuthorizationException){
                return response()->json(['message'=>'error','error'=>'No posees permisos para esta acción','code'=>403],403);
            }
            if($exception instanceof NotFoundHttpException){
                //dd($exception);
                return response()->json(['message'=>'error','error'=>'No se encontró la URL especificada','code'=>404],404);
            }
            if($exception instanceof MethodNotAllowedHttpException){
                return response()->json(['message'=>'error','error'=>'El método especificado en la peticion no es valido','code'=>405],405);
            }
            if($exception instanceof HttpException){
                return response()->json(['message'=>'error','error'=>$exception->getMessage(),'code'=>$exception->getStatusCode()],$exception->getStatusCode());
            }
            if($exception instanceof QueryException){
                $codigo = $exception->errorInfo[1];
                //dd($exception);
                if($codigo == 1451){
                    return response()->json([
                        'message'=>'error',
                        'error'=>'No se puede eliminar de forma permanente el recurso porque esta relacionado con algun otro',
                        'code'=>409],409);
                }
                if($codigo == 1045){
                    return response()->json(['message'=>'error','error'=>'Credenciales incorrectas al conectarse a la BD','code'=>409],409);
                }
                if($codigo == 1062){
                    return response()->json(['message'=>'error','error'=>'El email ya se encuentra registrado','code'=>409],409);
                }
            }
            return response()->json(['message'=>'error','error'=>'Falla inesperada. Intente Luego'.$exception,'code'=>500],500);
        }

        // 404 page with status code 200
        if ($exception instanceof NotFoundHttpException) {
            
            return redirect()->route('not-found', App::getLocale());
        }

        return parent::render($request, $exception);
        
    }

    protected function unauthenticated($request,AuthenticationException $exception){
        //return $this->errorResponse('error','No Autenticado',401);
        //return parent::render($request, $exception);
        dd($exception);
        return redirect()->route('no-authorized',App::getLocale());
    }
}
