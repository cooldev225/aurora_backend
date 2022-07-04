<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnestheticQuestionController;
use App\Http\Controllers\AnestheticAnswerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\BirthCodeController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HealthFundController;
use App\Http\Controllers\OrganizationAdminController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationManagerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProcedureQuestionController;
use App\Http\Controllers\ProdaDeviceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SpecialistTitleController;
use App\Http\Controllers\SpecialistTypeController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\NotificationTemplateController;
use App\Http\Controllers\PatientRecallController;

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
            SpecialistTitleController::class
        );
        Route::apiResource('birth-codes', BirthCodeController::class);
        Route::apiResource('health-funds', HealthFundController::class);
    });

    Route::middleware(['ensure.role:organizationAdmin'])->group(function () {
        Route::apiResource('clinics', ClinicController::class);
        Route::apiResource(
            'organization-admins',
            OrganizationAdminController::class
        );
        Route::apiResource(
            'organization-managers',
            OrganizationManagerController::class
        );
        Route::apiResource('email-templates', EmailTemplateController::class);
    });

    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager',
    ])->group(function () {
        Route::apiResource('proda-devices', ProdaDeviceController::class);
        Route::apiResource(
            'anesthetic-questions',
            AnestheticQuestionController::class
        );
        Route::apiResource(
            'procedure-questions',
            ProcedureQuestionController::class
        );
        Route::apiResource(
            'appointments/{appointment_id}/questions/{question_id}/anesthetic-answers',
            AnestheticAnswerController::class
        );
        Route::apiResource('patients', PatientController::class);
        Route::apiResource('employees', EmployeeController::class);
        Route::apiResource('specialists', SpecialistController::class);
        Route::apiResource(
            'appointment-types',
            AppointmentTypeController::class
        );
        Route::apiResource(
            'notification-templates',
            NotificationTemplateController::class
        );
        Route::get('/employee-roles', [
            UserRoleController::class,
            'employeeRoles',
        ]);
        Route::get('/patient-recalls', [
            PatientRecallController::class,
            'index',
        ]);
    });

    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager,receptionist',
    ])->group(function () {
        Route::apiResource('clinics/{clinic_id}/rooms', RoomController::class);
        Route::apiResource('appointments', AppointmentController::class);
        Route::get('/appointment-types', [
            AppointmentTypeController::class,
            'index',
        ]);
        Route::get('/work-hours', [SpecialistController::class, 'workHours']);
        Route::get('/clinics', [ClinicController::class, 'index']);
        Route::get('/anesthetists', [
            EmployeeController::class,
            'anesthetists',
        ]);
        Route::get('/health-funds', [HealthFundController::class, 'index']);
        Route::get('/anesthetic-questions', [
            AnestheticQuestionController::class,
            'index',
        ]);
        Route::get('/procedure-questions', [
            ProcedureQuestionController::class,
            'index',
        ]);
    });
});
