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
use App\Http\Controllers\API\Tiendas\TiendaController;
use App\Http\Controllers\API\Categorias\CategoriaControler;
use App\Http\Controllers\API\Subcategorias\SubcategoriaController;

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

//ENDPOINTS PARA LLENAR LA BD YA SEA DE UN API O ARCHIVOS DE EXCEL -- SIEMPRE EJECUTARLOS AL HACER GIT CLONE 
Route::get('sync-paises-data',[PaisController::class,'syncData']);
Route::get('import-categorias',[CategoriaControler::class,'syncData']);
Route::get('import-subcategorias',[SubcategoriaController::class,'syncData']);
Route::get('import-child',[SubcategoriaController::class,'syncChild']);
Route::get('sync-divisa',[DivisaController::class,'import']);
//Route::post('export-excel',[CategoriaControler::class,'storeFile']);

Route::get('categorias',[CategoriaControler::class,'index']);
Route::get('categoria/{id}',[CategoriaControler::class,'show']);

Route::get('subcategorias',[SubcategoriaController::class,'index']);
Route::get('subcategoria/{id}',[SubcategoriaController::class,'show']);
Route::get('subcategoria-child/{id}',[SubcategoriaController::class,'showChild']);

Route::get('paises',[PaisController::class,'index']);
Route::get('pais/{id}',[PaisController::class,'show']);

Route::get('divisas',[DivisaController::class,'index']);
Route::get('divisa/{id}',[DivisaController::class,'show']);


//verified.email
Route::middleware(['auth:sanctum'])->group(function (){

    Route::post('logout',[LoginController::class,'logout']);

    Route::get('proveedores',[ProveedorController::class,'index']);
    Route::get('proveedor/{id}',[ProveedorController::class,'show']);
    Route::post('proveedor/{id}',[ProveedorController::class,'update']);
    Route::delete('delete-proveedor/{id}',[ProveedorController::class,'destroy']);
    Route::get('restore-proveedor/{id}',[ProveedorController::class,'restore']);

    Route::get('clientes',[ClienteController::class,'index']);
    Route::get('cliente/{id}',[ClienteController::class,'show']);
    Route::post('cliente/{id}',[ClienteController::class,'update']);
    Route::delete('delete-cliente/{id}',[ClienteController::class,'destroy']);
    Route::get('restore-cliente/{id}',[ClienteController::class,'restore']);

    
    Route::post('divisa/{id}',[DivisaController::class,'update']);
    Route::post('store-divisa',[DivisaController::class,'store']);
    Route::delete('delete-divisa/{id}',[DivisaController::class,'destroy']);
    Route::get('restore-divisa/{id}',[DivisaController::class,'restore']);


    //RUTAS DE DIRECCIONES PARA CLIENTES FINALES
    Route::get('direcciones',[DireccionController::class,'index']);
    Route::get('direccion/{id}',[DireccionController::class,'show']);
    Route::post('direccion/{id}',[DireccionController::class,'update']);
    Route::post('store-direccion',[DireccionController::class,'store']);
    Route::delete('delete-direccion/{id}',[DireccionController::class,'delete']);

    Route::get('tiendas',[TiendaController::class,'index']);
    Route::get('tienda/{id}',[TiendaController::class,'show']);
    Route::post('tienda/{id}',[TiendaController::class,'update']);
    Route::post('tienda',[TiendaController::class,'store']);

    
    Route::post('categoria/{id}',[CategoriaControler::class,'update']);
    Route::post('categoria',[CategoriaControler::class,'store']);
    Route::delete('categoria/{id}',[CategoriaControler::class,'delete']);
    

    Route::post('subcategoria/{id}',[SubcategoriaController::class,'update']);
    Route::post('subcategoria',[SubcategoriaController::class,'store']);
    Route::delete('subcategoria/{id}',[SubcategoriaController::class,'delete']);

    
    Route::delete('delete-pais',[PaisController::class,'destroy']);
    Route::get('restore-pais',[PaisController::class,'restore']);

});

