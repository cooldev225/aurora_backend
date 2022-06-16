<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Middleware\EnsureAdmin;

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

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('/login', [UserController::class, 'login']);

    Route::middleware(['auth'])->group(function () {
        Route::post('/users', [UserController::class, 'create']);
        Route::post('/logout', [UserController::class, 'logout']);
        Route::post('/refresh', [UserController::class, 'refresh']);
        Route::post('/profile', [UserController::class, 'profile']);

        Route::middleware([EnsureAdmin::class])->group(function () {
            Route::apiResource('user-roles', UserRoleController::class);
        });
    });
});