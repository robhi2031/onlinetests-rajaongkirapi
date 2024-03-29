<?php

use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);

//Search Province & City
Route::group(['middleware' => 'auth.token.api'], function () {
    Route::controller(SearchController::class)->group(function () {
        Route::group(['prefix' => 'search'], function () {
            Route::get('/provinces', 'searchProvinces');
            Route::get('/cities', 'searchCities');
        });
    });

    Route::get('/logout', [AuthController::class, 'logout']);
});
