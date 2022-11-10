<?php

use App\Http\Controllers\AppointmentPreAdmissionController;
use App\Http\Controllers\AppointmentSearchAvailableController;
use App\Http\Controllers\HL7TestController;
use App\Http\Controllers\ReportVAEDController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    // $filename = str_replace('pre_admission', '', 'pre_admission_51_1663207992.pdf');
    //     $file_parts = explode('_', $filename);

    //     dd($file_parts);

    return Illuminate\Support\Facades\Storage::temporaryUrl('/files/1/patient_document_202_1668058691.pdf', now()->addMinutes(10));
});

Route::get('/test-pdf', [AppointmentPreAdmissionController::class, 'testPDF']);
Route::get('/test-hl7parse', [HL7TestController::class, 'testHL7Parse']);
Route::get('/test-hl7create', [HL7TestController::class, 'createHealthLinkMessage']);
Route::get('/test-apt-count', [AppointmentSearchAvailableController::class, 'appointmentCount']);
Route::get('/VAED-report-test', [ReportVAEDController::class, 'generateVAEDforEpisode']);