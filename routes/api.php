<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('pay', [\App\Http\Controllers\FatoorahController::class, 'payOrder']);

Route::get('paymentCallback', [\App\Http\Controllers\FatoorahController::class, 'paymentCallback']);
Route::get('paymentError', [\App\Http\Controllers\FatoorahController::class, 'paymentError']);

