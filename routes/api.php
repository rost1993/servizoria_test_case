<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RateController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/unauthorized', [AuthenticatedSessionController::class, 'unauthorized']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/currency', [CurrencyController::class, 'index']);
    Route::post('/rate', [RateController::class, 'search']);
});

