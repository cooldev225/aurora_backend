<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnestheticQuestionController;
use App\Http\Controllers\AnestheticAnswerController;
use App\Http\Controllers\Anesthetist\ProcedureApprovalController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentPreAdmissionController;
use App\Http\Controllers\AppointmentProcedureApprovalController;
use App\Http\Controllers\AppointmentReferralController;
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
use App\Http\Controllers\PatientDocumentReportController;
use App\Models\AppointmentPreAdmission;

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
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/verify_token', [UserController::class, 'verify_token']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/refresh', [UserController::class, 'refresh']);
    Route::post('/update-profile', [UserController::class, 'updateProfile']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/change-password', [UserController::class, 'changePassword']);

    Route::get('/referring-doctors/list', [
        ReferringDoctorController::class,
        'list',
    ]);

    ////////////////////////////////////////////////////////////////////////////////////
    // Appointment Pre Admission
    Route::get('/appointment_pre_admissions/show/{token}', [
        AppointmentPreAdmissionController::class,
        'show',
    ]);
    Route::post('/appointment_pre_admissions/validate/{token}', [
        AppointmentPreAdmissionController::class,
        'validate_pre_admission',
    ]);
    Route::post('/appointment_pre_admissions/store/{token}', [
        AppointmentPreAdmissionController::class,
        'store',
    ]);

    Route::post('/mails/send', [MailController::class, 'send']);
    Route::post('/mails/send-draft', [MailController::class, 'sendDraft']);
    Route::post('/mails/update-draft', [MailController::class, 'updateDraft']);
    Route::put('/mails/bookmark/{id}', [MailController::class, 'bookmark']);
    Route::put('/mails/delete/{id}', [MailController::class, 'delete']);
    Route::put('/mails/restore/{id}', [MailController::class, 'restore']);
    Route::apiResource('mails', MailController::class);

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
        Route::apiResource(
            'referring-doctors',
            ReferringDoctorController::class
        );
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
        Route::apiResource(
            'appointment-time-requirements',
            AppointmentTimeRequirementController::class
        );
        Route::apiResource(
            'appointment-types',
            AppointmentTypeController::class
        );
        Route::get('/specialist-titles', [SpecialistTitleController::class, 'index']);
        Route::get('/specialist-types', [SpecialistTypeController::class, 'index']);
    });

    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager',
    ])->group(function () {
        Route::apiResource('proda-devices', ProdaDeviceController::class);
        Route::apiResource(
            'notification-templates',
            NotificationTemplateController::class
        );

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
        Route::apiResource('employees', EmployeeController::class);
        Route::apiResource('specialists', SpecialistController::class);
        Route::get('/employee-roles', [
            UserRoleController::class,
            'employeeRoles',
        ]);

        Route::apiResource('patient-recalls', PatientRecallController::class);

        Route::apiResource('report-templates', ReportTemplateController::class);
        Route::apiResource(
            'pre-admission-sections',
            PreAdmissionController::class
        );
        Route::put('update-pre-admission-consent', [
            PreAdmissionController::class,
            'updateConsent',
        ]);

        Route::post('/notification-test', [
            NotificationTestController::class,
            'testSendNotification',
        ]);

        Route::get('payments', [PaymentController::class, 'index']);
        Route::get('payments/{appointment}', [PaymentController::class, 'show']);
        Route::post('payments', [PaymentController::class, 'store']);
    });

    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager,receptionist, anesthetist, specialist',
    ])->group(function () {
        Route::apiResource('clinics/{clinic_id}/rooms', RoomController::class);
        Route::apiResource('appointments', AppointmentController::class);
        Route::put('/appointments/approve/{id}', [
            AppointmentController::class,
            'approve',
        ]);

        Route::put('/appointments/update_collecting_person/{id}', [
            AppointmentController::class,
            'updateCollectingPerson',
        ]);

        Route::put('/appointments/procedureApprovalStatus/{appointment}', [
            AppointmentProcedureApprovalController::class,
            'update',
        ]);

        Route::put('/appointments/check-in/{id}', [
            AppointmentController::class,
            'checkIn',
        ]);
        Route::put('/appointments/check-out/{id}', [
            AppointmentController::class,
            'checkOut',
        ]);
        Route::put('/appointments/cancel/{id}', [
            AppointmentController::class,
            'cancel',
        ]);
        Route::put('/appointments/wait-listed/{id}', [
            AppointmentController::class,
            'waitListed',
        ]);

        Route::put('/appointment-referrals/update/{id}', [
            AppointmentReferralController::class,
            'update',
        ]);

        Route::get('/available-slots', [
            AppointmentController::class,
            'availableSlots',
        ]);
        Route::get('/organizations', [OrganizationController::class, 'index']);
        Route::get('/appointment-types', [
            AppointmentTypeController::class,
            'index',
        ]);
        Route::get('appointment-time-requirements', [
            AppointmentTimeRequirementController::class,
            'index',
        ]);
        Route::get('/work-hours', [SpecialistController::class, 'workHours']);
        Route::get('/work-hours-by-week', [
            SpecialistController::class,
            'workHoursByWeek',
        ]);
        Route::get('/clinics', [ClinicController::class, 'index']);
        Route::get('/specialists', [SpecialistController::class, 'index']);
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
        Route::get('/notification-templates', [
            NotificationTemplateController::class,
            'index',
        ]);

        Route::apiResource('patient-documents', PatientDocumentController::class);
        Route::post('patient-documents/upload', [PatientDocumentController::class, 'upload']);

        Route::apiResource('patient-documents-letter', PatientDocumentLetterController::class);
        Route::post('{patient}/letter/upload', [PatientDocumentLetterController::class, 'upload']);

        Route::apiResource('patient-documents-report', PatientDocumentReportController::class);
        Route::post('{patient}/report/upload', [PatientDocumentReportController::class, 'upload']);

        Route::apiResource('patient-documents-clinical-note', PatientDocumentClinicalNoteController::class);
        Route::post('{patient}/clinical-note/upload', [PatientDocumentClinicalNoteController::class, 'upload']);

        Route::apiResource('patient-documents-audio', PatientDocumentAudioController::class);
        Route::post('{patient}/audio/upload', [PatientDocumentAudioController::class, 'upload']);

        Route::post('{appointment}/pre-admission/upload', [
            AppointmentPreAdmissionController::class,
            'upload',
        ]);
    });

    Route::middleware([
        'ensure.role:organizationAdmin,organizationManager,specialist',
    ])->group(function () {
        Route::apiResource('patients', PatientController::class);
        Route::get('patients/appointments/{patient}', [PatientController::class, 'appointments']);

        Route::apiResource('letter-templates', LetterTemplateController::class);
    });

    Route::middleware(['ensure.role:anesthetist'])->group(function () {
        Route::get('/procedure-approvals', [AppointmentProcedureApprovalController::class, 'index']);

        Route::put('{appointment}/procedure-approvals', [
            AppointmentProcedureApprovalController::class,
            'update',
        ]);
    });
});


