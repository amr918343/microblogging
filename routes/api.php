<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Follow\FollowController;
use App\Http\Controllers\Api\Tweet\TimelineController;
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
Route::group(['middleware' => 'changeLanguage'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class, 'signup']);
        Route::post('login', [AuthController::class, 'signin'])->name('login');
    });

    Route::middleware('auth:sanctum')->group(function() {
        Route::group(['prefix' => 'auth'], function () {
            Route::get('logout', [AuthController::class, 'logout']);
        });

        Route::get('timeline', [TimelineController::class, 'getTimeline']);
        Route::get('toggle-follow/{user}', [FollowController::class, 'toggleFollow']);
    });
});
