<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SpecialistTypeController;
use App\Http\Controllers\BirthCodeController;
use App\Http\Controllers\HealthFundController;
use App\Http\Controllers\ClinicController;

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

Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/verify_token', [UserController::class, 'verify_token']);
    Route::post('/users', [UserController::class, 'create']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/refresh', [UserController::class, 'refresh']);
    Route::post('/profile', [UserController::class, 'profile']);

    Route::middleware(['ensure.role:admin'])->group(function () {
        Route::apiResource('admins', AdminController::class);
        Route::apiResource('user-roles', UserRoleController::class);
        Route::apiResource('organizations', OrganizationController::class);
        Route::apiResource('specialist-types', SpecialistTypeController::class);
        Route::apiResource(
            'specialist-titles',
            SpecialistTypeController::class
        );
        Route::apiResource('birth-codes', BirthCodeController::class);
    });

    Route::middleware(['ensure.role:organization-admin'])->group(function () {
        Route::apiResource('clinics', ClinicController::class);
    });
});
