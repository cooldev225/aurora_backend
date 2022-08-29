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
use App\Http\Controllers\LetterTemplateController;
use App\Http\Controllers\NotificationTestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PreAdmissionController;
use App\Http\Controllers\ReferringDoctorController;
use App\Http\Controllers\ReportTemplateController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PatientDocumentAudioController;
use App\Http\Controllers\PatientDocumentClinicalNoteController;
use App\Http\Controllers\PatientDocumentController;
use App\Http\Controllers\PatientDocumentLetterController;
use App\Http\Controllers\PatientDocumentOtherController;
use App\Http\Controllers\PatientDocumentReportController;
use App\Http\Controllers\UserAppointmentController;

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
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/refresh', [UserController::class, 'refresh']);

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/update-profile', [UserController::class, 'updateProfile']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/change-password', [UserController::class, 'changePassword']);

    ////////////////////////////////////////////////////////////////////////////////////
    // Appointment Pre Admission Routes (role:none)
    Route::prefix('appointments/pre-admissions')->group(function () {
        Route::get('/show/{token}',         [AppointmentPreAdmissionController::class,'show',]);
        Route::post('/validate/{token}',    [AppointmentPreAdmissionController::class, 'validate_pre_admission']);
        Route::post('/store/{token}',       [AppointmentPreAdmissionController::class,'store']);
    });


    ////////////////////////////////////////////////////////////////////////////////////
    // Internal Mail Routes (role:all)
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
    // Super Admin Only Routes (role:admin)
    Route::middleware(['ensure.role:admin'])->group(function () {
        Route::apiResource('admins',        AdminController::class, ['except' => ['show']]);
        Route::apiResource('organizations', OrganizationController::class, ['except' => ['show']]);
        Route::apiResource('birth-codes',   BirthCodeController::class,['except' => ['show']]);
        Route::apiResource('health-funds',  HealthFundController::class,['except' => ['show']]);
    });

     ////////////////////////////////////////////////////////////////////////////////////
    // Organization Admin Only Routes (role:organizationAdmin)
    Route::middleware(['ensure.role:organizationAdmin'])->group(function () {
        Route::apiResource('clinics',               ClinicController::class,['except' => ['show']]);
        Route::apiResource('organization-admins',   OrganizationAdminController::class,['except' => ['show']]);
        Route::apiResource('organization-managers', OrganizationManagerController::class,['except' => ['show']]);
        Route::apiResource('appointment-time-requirements',AppointmentTimeRequirementController::class,['except' => ['show']]);
        Route::apiResource('appointment-types',AppointmentTypeController::class,['except' => ['show']]);
        Route::apiResource('notification-templates', NotificationTemplateController::class, ['except' => ['show']]);
    });

    ////////////////////////////////////////////////////////////////////////////////////
    // Organization Admin and Organization Manager Routes (role:organizationAdmin,organizationManager)
    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager',
    ])->group(function () {

        Route::apiResource('anesthetic-questions', AnestheticQuestionController::class,['except' => ['show']]);
        Route::apiResource('employees', EmployeeController::class,['except' => ['show']]);
        Route::apiResource('specialists', SpecialistController::class,['except' => ['show']]);
        Route::get('/employee-roles', [UserRoleController::class,'employeeRoles']);
        Route::apiResource('report-templates', ReportTemplateController::class,['except' => ['show']]);
        Route::apiResource('pre-admission-sections',PreAdmissionController::class,['except' => ['show']]);
        Route::post('update-pre-admission-consent', [PreAdmissionController::class,'updateConsent']);
        Route::get('get-pre-admission-consent', [PreAdmissionController::class,'getConsent',]);

        Route::post('/notification-test', [
            NotificationTestController::class,
            'testSendNotification',
        ]);

        Route::get('payments', [PaymentController::class, 'index']);
        Route::get('payments/{appointment}', [PaymentController::class, 'show']);
        Route::post('payments', [PaymentController::class, 'store']);
    });
    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager,receptionist,anesthetist,specialist',
    ])->group(function () {
        Route::post('/appointments/referral/file', [AppointmentReferralController::class,'file']);
    });

    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager,receptionist,anesthetist,specialist',
    ])->group(function () {

        Route::apiResource('clinics/{clinic_id}/rooms',RoomController::class,['except' => ['show']]);

        Route::apiResource('referring-doctors', ReferringDoctorController::class,['except' => ['show']]);

        Route::get('user-appointments', [UserAppointmentController::class, 'index']);


        Route::apiResource('appointments', AppointmentController::class, ['except' => ['destroy']]);
        Route::prefix('appointments')->group(function () {
            Route::get('/confirmation-status', [AppointmentConformationStatusController::class, 'index']);
            Route::put('/confirmation-status/{appointment}', [AppointmentConformationStatusController::class, 'update']);
            Route::put('/check-in/{appointment}', [AppointmentAttendanceStatusController::class,'checkIn']);
            Route::put('/check-out/{appointment}', [AppointmentAttendanceStatusController::class, 'checkOut']);

            Route::put('/wait-listed/{appointment}', [AppointmentController::class,'waitListed']);
            Route::put('/procedureApprovalStatus/{appointment}', [AppointmentProcedureApprovalController::class,'update']);
            Route::put('/update_collecting_person/{appointment}', [AppointmentCollectingPersonController::class,'update']);

            Route::post('/referral/{appointment}', [AppointmentReferralController::class,'update']);
        });


        Route::get('/available-slots', [AppointmentSearchAvailableController::class, 'index']);
        Route::get('/organizations', [OrganizationController::class, 'index']);
        Route::get('/appointment-types', [AppointmentTypeController::class,'index']);
        Route::get('appointment-time-requirements', [AppointmentTimeRequirementController::class,'index']);
        Route::get('/work-hours', [SpecialistController::class, 'workHours']);
        Route::get('/work-hours-by-week', [SpecialistController::class,'workHoursByWeek']);
        Route::get('/clinics', [ClinicController::class, 'index']);
        Route::get('/specialists', [SpecialistController::class, 'index']);
        Route::get('/anesthetists', [EmployeeController::class,'anesthetists']);

        Route::get('/health-funds', [HealthFundController::class, 'index']);
        Route::get('/notification-templates', [NotificationTemplateController::class,'index',]);



        Route::post('patient-documents/upload', [PatientDocumentController::class, 'upload']);

        Route::apiResource('patient-documents-letter',
            PatientDocumentLetterController::class,
            ['except' => ['index', 'show']]
        );
        Route::post('patient-document/{patient}/letter/upload',
            [PatientDocumentLetterController::class, 'upload']
        );

        Route::apiResource('patient-documents-report',
            PatientDocumentReportController::class,
            ['except' => ['index', 'show']]
        );
        Route::post('patient-document/{patient}/report/upload',
            [PatientDocumentReportController::class, 'upload']
        );

        Route::apiResource('patient-documents-clinical-note',
            PatientDocumentClinicalNoteController::class,
            ['except' => ['index', 'show']]
        );
        Route::post('patient-document/{patient}/clinical-note/upload',
            [PatientDocumentClinicalNoteController::class, 'upload']
        );

        Route::apiResource('patient-documents-audio',
            PatientDocumentAudioController::class,
            ['except' => ['index', 'show']]
        );
        Route::post('patient-document/{patient}/audio/upload',
            [PatientDocumentAudioController::class, 'upload']
        );

        Route::post('patient-document/{patient}/other/upload',
            [PatientDocumentOtherController::class, 'upload']
        );

    });

    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager,specialist',
    ])->group(function () {

        Route::apiResource('patients', PatientController::class, ['except' => ['create']]);
        Route::prefix('patients')->group(function () {
            Route::get('recalls/{patient}', [PatientRecallController::class, 'index']);
            Route::apiResource('recalls', PatientRecallController::class, ['except' => ['show', 'index']]);
            Route::get('appointments/{patient}', [PatientController::class, 'appointments']);
           
            Route::get('documents/{patient}', [PatientController::class, 'index']);
            Route::post('documents/{patient}', [PatientController::class, 'store']);
            Route::put('documents/{patient}', [PatientController::class, 'update']);
        });

        Route::apiResource('letter-templates', LetterTemplateController::class, ['except' => ['show']]);
    });

    Route::middleware(['ensure.role:anesthetist'])->group(function () {
        Route::get('/procedure-approvals', [AppointmentProcedureApprovalController::class, 'index']);
        Route::put('appointment/{appointment}/procedure-approvals', [ AppointmentProcedureApprovalController::class,'update']);
    });
});


