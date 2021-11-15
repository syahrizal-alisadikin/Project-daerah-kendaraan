<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
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

Route::get('/unit/{id}',[ApiController::class,'ApiUnit']);
Route::get('/subunit/{id}',[ApiController::class,'ApiSubUnit']);
Route::get('/upb/{id}',[ApiController::class,'ApiUpb']);
Route::get('/user/{id}',[ApiController::class,'ApiUser']);
Route::get('/tanah/{id}',[ApiController::class,'ApiTanah']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
