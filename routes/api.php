<?php

use App\Http\Controllers\PrecioController;
use Illuminate\Http\Request;
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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::apiResource('/precios', PrecioController::class);

Route::fallback(function(){
    return response()->json([
        'status' => false,
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'The HTTP request made could not be found or is temporarily disabled. If error persists, contact admin@info.com'
    ], 404);
});
