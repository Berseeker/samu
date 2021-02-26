<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\VerifyEmailController;
use App\Http\Controllers\API\Clientes\ClienteController;
use App\Http\Controllers\API\Proveedores\ProveedorController;
use App\Http\Controllers\API\Divisas\DivisaController;
use App\Http\Controllers\API\Paises\PaisController;
use App\Http\Controllers\API\Direcciones\DireccionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('create-user',[RegisterController::class,'store']);
Route::post('login',[LoginController::class,'index']);

Route::middleware('auth:sanctum')->get('verify-email',[VerifyEmailController::class,'index']);

Route::get('sync-paises-data',[PaisController::class,'syncData']);
Route::get('paises',[PaisController::class,'index']);
Route::get('pais/{id}',[PaisController::class,'show']);
Route::delete('delete-pais',[PaisController::class,'destroy']);
Route::get('restore-pais',[PaisController::class,'restore']);

//verified.email
Route::middleware(['auth:sanctum'])->group(function (){

    Route::post('logout',[LoginController::class,'logout']);

    Route::get('proveedores',[ProveedorController::class,'index']);
    Route::get('show-proveedor/{id}',[ProveedorController::class,'show']);
    Route::post('update-proveedor/{id}',[ProveedorController::class,'update']);
    Route::delete('delete-proveedor/{id}',[ProveedorController::class,'destroy']);
    Route::get('restore-proveedor/{id}',[ProveedorController::class,'restore']);

    Route::get('clientes',[ClienteController::class,'index']);
    Route::get('show-cliente/{id}',[ClienteController::class,'show']);
    Route::post('update-cliente/{id}',[ClienteController::class,'update']);
    Route::delete('delete-cliente/{id}',[ClienteController::class,'destroy']);
    Route::get('restore-cliente/{id}',[ClienteController::class,'restore']);

    Route::get('divisas',[DivisaController::class,'index']);
    Route::get('show-divisa/{id}',[DivisaController::class,'show']);
    Route::post('update-divisa/{id}',[DivisaController::class,'update']);
    Route::post('store-divisa',[DivisaController::class,'store']);
    Route::delete('delete-divisa/{id}',[DivisaController::class,'destroy']);
    Route::get('restore-divisa/{id}',[DivisaController::class,'restore']);

    //RUTAS DE DIRECCIONES PARA CLIENTES FINALES
    Route::get('direcciones',[DireccionController::class,'index']);
    Route::get('show-direccion/{id}',[DireccionController::class,'show']);
    Route::post('store-direccion',[DireccionController::class,'store']);
    Route::post('update-direccion',[DireccionController::class,'update']);
    Route::delete('delete-direccion/{id}',[DireccionController::class,'delete']);

});

