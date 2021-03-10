<?php

use App\Http\Controllers\WEB\Auth\AuthController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\WEB\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('login', [AuthController::class,'login'])->name('login');
Route::get('/registro', [AuthController::class,'registro'])->name('registro');

Route::get('/pusher',function(){
    
    return 'tienda stored';
});



// URL PARA VERIFICAR EL EMAIL
Route::get('/verify-email-custom/{id}/{hash}', [VerifyEmailController::class, 'index'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verify.email.custom');

Route::middleware(['auth:sanctum','verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
