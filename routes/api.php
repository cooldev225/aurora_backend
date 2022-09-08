<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnestheticQuestionController;
use App\Http\Controllers\AppointmentAttendanceStatusController;
use App\Http\Controllers\AppointmentCollectingPersonController;
use App\Http\Controllers\AppointmentConformationStatusController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentPreAdmissionController;
use App\Http\Controllers\AppointmentProcedureApprovalController;
use App\Http\Controllers\AppointmentReferralController;
use App\Http\Controllers\AppointmentSearchAvailableController;
use App\Http\Controllers\AppointmentSpecialistController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\BirthCodeController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HealthFundController;
use App\Http\Controllers\OrganizationAdminController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationManagerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\NotificationTemplateController;
use App\Http\Controllers\PatientRecallController;
use App\Http\Controllers\AppointmentTimeRequirementController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LetterTemplateController;
use App\Http\Controllers\NotificationTestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PreAdmissionController;
use App\Http\Controllers\ReferringDoctorController;
use App\Http\Controllers\ReportTemplateController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PatientDocumentController;
use App\Http\Controllers\UserAppointmentController;
use App\Http\Requests\FileRequest;
use App\Models\PatientBilling;

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

    ////////////////////////////////////////////////////////////////////////////////////
    // Account & Auth Routes
    Route::post('/verify_token',    [UserController::class, 'verify_token']);
    Route::post('/logout',          [UserController::class, 'logout']);
    Route::post('/refresh',         [UserController::class, 'refresh']);

    Route::post('/update-profile',  [UserController::class, 'updateProfile']);
    Route::get('/profile',          [UserController::class, 'profile']);
    Route::post('/change-password', [UserController::class, 'changePassword']);

    ////////////////////////////////////////////////////////////////////////////////////
    // Appointment Routes
    Route::prefix('appointments')->group(function () {
        Route::put('/wait-listed/{appointment}',              [AppointmentController::class,'waitListed']);

        Route::get('/byDate',                                 [AppointmentConformationStatusController::class, 'index']);
        Route::get('/confirmation-status',                    [AppointmentConformationStatusController::class, 'index']);
        Route::put('/confirmation-status/{appointment}',      [AppointmentConformationStatusController::class, 'update']);

        Route::put('/check-in/{appointment}',                 [AppointmentAttendanceStatusController::class,'checkIn']);
        Route::put('/check-out/{appointment}',                [AppointmentAttendanceStatusController::class, 'checkOut']);

        Route::put('/procedureApprovalStatus/{appointment}',  [AppointmentProcedureApprovalController::class,'update']);
        Route::post('/referral/{appointment}',                [AppointmentReferralController::class,'update']);
        Route::get('/specialists',                            [AppointmentSpecialistController::class, 'index']);
        Route::put('/update_collecting_person/{appointment}', [AppointmentCollectingPersonController::class,'update']);
    });
    

    ////////////////////////////////////////////////////////////////////////////////////
    // Appointment Pre Admission Routes
    Route::prefix('appointments/pre-admissions')->group(function () {
        Route::get('/show/{token}',         [AppointmentPreAdmissionController::class,'show',]);
        Route::post('/validate/{token}',    [AppointmentPreAdmissionController::class, 'validatePreAdmission']);
        Route::post('/store/{token}',       [AppointmentPreAdmissionController::class,'store']);
    });

    Route::post('update-pre-admission-consent', [PreAdmissionController::class,'updateConsent']);
    Route::get('get-pre-admission-consent',     [PreAdmissionController::class,'getConsent',]);

    ////////////////////////////////////////////////////////////////////////////////////
    // Internal Mail Routes
    Route::prefix('mails')->group(function () {
        Route::apiResource('/',             MailController::class,['except' => ['update']]);
        Route::post('/send',                [MailController::class, 'send']);
        Route::post('/send-draft',          [MailController::class, 'sendDraft']);
        Route::post('/update-draft',        [MailController::class, 'updateDraft']);
        Route::put('/bookmark/{id}',        [MailController::class, 'bookmark']);
        Route::put('/delete/{id}',          [MailController::class, 'delete']);
        Route::put('/restore/{id}',         [MailController::class, 'restore']);
    });

    ////////////////////////////////////////////////////////////////////////////////////
    // Patient Routes
    Route::prefix('patients')->group(function () {
        Route::get('/appointments/{patient}', [PatientController::class, 'appointments']);
        Route::get('/billing/{patient}', [PatientBilling::class, 'update']);
       
        Route::get('/documents/{patient}',    [PatientDocumentController::class, 'index']);
        Route::post('/documents/{patient}',   [PatientDocumentController::class, 'store']);

        Route::apiResource('/recalls',        PatientRecallController::class, ['except' => ['show', 'index']]);
        Route::get('/recalls/{patient}',      [PatientRecallController::class, 'index']);
    });

    ////////////////////////////////////////////////////////////////////////////////////
    // Payment Routes
    Route::prefix('payments')->group(function () {
        Route::get('/',              [PaymentController::class, 'index']);
        Route::post('/',             [PaymentController::class, 'store']);
        Route::get('/{appointment}', [PaymentController::class, 'show']);
    });

    ////////////////////////////////////////////////////////////////////////////////////
    // API Resources
    Route::apiResource('/admins',                        AdminController::class, ['except' => ['show']])->parameters(['admins' => 'user']);
    Route::apiResource('/anesthetic-questions',          AnestheticQuestionController::class,['except' => ['show']]);
    Route::apiResource('/appointments',                  AppointmentController::class, ['except' => ['destroy']]);
    Route::apiResource('/appointment-time-requirements', AppointmentTimeRequirementController::class,['except' => ['show']]);
    Route::apiResource('/appointment-types',             AppointmentTypeController::class,['except' => ['show']]);
    Route::apiResource('/birth-codes',                   BirthCodeController::class,['except' => ['show']]);
    Route::apiResource('/clinics',                       ClinicController::class,['except' => ['show']]);
    Route::apiResource('/clinics/{clinic_id}/rooms',     RoomController::class,['except' => ['show']]);
    Route::apiResource('/health-funds',                  HealthFundController::class,['except' => ['show']]);
    Route::apiResource('/letter-templates',              LetterTemplateController::class, ['except' => ['show']]);
    Route::apiResource('/notification-templates',        NotificationTemplateController::class, ['except' => ['show']]);
    Route::apiResource('/organizations',                 OrganizationController::class, ['except' => ['show']]);
    Route::apiResource('/organization-admins',           OrganizationAdminController::class,['except' => ['show']])->parameters(['organization_admin' => 'user']);
    Route::apiResource('/patients',                      PatientController::class, ['except' => ['create']]);
    Route::apiResource('/pre-admission-sections',        PreAdmissionController::class,['except' => ['show']]);
    Route::apiResource('/referring-doctors',             ReferringDoctorController::class,['except' => ['show']]);
    Route::apiResource('/report-templates',              ReportTemplateController::class,['except' => ['show']]);
    Route::apiResource('/specialists',                   SpecialistController::class,['except' => ['show']]);
    Route::apiResource('/users',                         UserController::class);

    ////////////////////////////////////////////////////////////////////////////////////
    // Other Routes
    // Route::get('/anesthetists',                                  [EmployeeController::class,'anesthetists']);
    Route::put('/appointment/procedure-approvals/{appointment}', [AppointmentProcedureApprovalController::class,'update']);
    Route::get('/available-timeslots',                           [AppointmentSearchAvailableController::class, 'index']);
    Route::get('/employee-roles',                                [UserRoleController::class,'employeeRoles']);
    Route::post('/file',                                         [FileController::class,'show']);
    Route::get('/procedure-approvals',                           [AppointmentProcedureApprovalController::class, 'index']);
    Route::get('/user-appointments',                             [UserAppointmentController::class, 'index']);


    Route::post('/notification-test', [NotificationTestController::class,'testSendNotification']);
});