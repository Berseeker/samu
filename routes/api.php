<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\VerifyEmailController;
use App\Http\Controllers\API\Clientes\ClienteController;
use App\Http\Controllers\API\Proveedores\ProveedorController;
use App\Http\Controllers\API\Divisas\DivisaController;

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

Route::get('sync-paises-data',[DivisaController::class,'syncData']);

//verified.email
Route::middleware(['auth:sanctum'])->group(function (){

    Route::post('logout',[LoginController::class,'logout']);

    Route::post('proveedores',[ProveedorController::class,'index']);
    Route::post('show-proveedor/{id}',[ProveedorController::class,'show']);
    Route::post('update-proveedor/{id}',[ProveedorController::class,'update']);
    Route::delete('delete-proveedor/{id}',[ProveedorController::class,'destroy']);
    Route::get('restore-proveedor/{id}',[ProveedorController::class,'restore']);

    Route::post('clientes',[ClienteController::class,'index']);
    Route::post('show-cliente/{id}',[ClienteController::class,'show']);
    Route::post('update-cliente/{id}',[ClienteController::class,'update']);
    Route::delete('delete-cliente/{id}',[ClienteController::class,'destroy']);
    Route::get('restore-cliente/{id}',[ClienteController::class,'restore']);

    Route::get('divisas',[DivisasController::class,'index']);
    Route::get('show-divisa/{id}',[DivisasController::class,'show']);
    Route::post('show-divisa/{id}',[DivisasController::class,'show']);
    Route::post('store-divisa',[DivisasController::class,'store']);
    Route::delete('delete-divisa',[DivisasController::class,'destroy']);

});

