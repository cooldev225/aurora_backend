<?php

use App\Http\Controllers\AppointmentPreAdmissionController;
use App\Http\Controllers\HL7TestController;
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
    $filename = str_replace('pre_admission', '', 'pre_admission_51_1663207992.pdf');
        $file_parts = explode('_', $filename);

        dd($file_parts);
});

Route::get('/test-pdf', [AppointmentPreAdmissionController::class, 'testPDF']);
Route::get('/test-hl7parse', [HL7TestController::class, 'testHL7Parse']);
