<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PrecioController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
});

Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::apiResource('/precios', PrecioController::class);
    Route::apiResource('/empresas', EmpresaController::class);
    Route::apiResource('/alumnos', AlumnoController::class);
    Route::apiResource('/pagos', PagoController::class);
});



Route::fallback(function(){
    return response()->json([
        'status' => false,
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'The HTTP request made could not be found or is temporarily disabled. If error persists, contact admin@info.com'
    ], 404);
});
