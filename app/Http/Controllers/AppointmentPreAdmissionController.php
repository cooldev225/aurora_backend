<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPreAdmissionRequest;
use App\Models\Appointment;
use App\Models\AppointmentPreAdmission;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use PDF;

class AppointmentPreAdmissionController extends Controller
{
    /**
     * [Pre Admission] - Show Initial Form
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $preAdmission = AppointmentPreAdmission::where('token', $token)
            ->first();

        if ($preAdmission == null) {
            return response()->json(
                [
                    'message'   => 'Appointment Pre Admission',
                    'data'      => null,
                ],
                Response::HTTP_OK
            );
        }

        $data = $preAdmission->getAppointmentPreAdmissionData();

        return response()->json(
            [
                'message'   => 'Appointment Pre Admission',
                'data'      => $data,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Validate Pre Admission
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function validate_pre_admission($token, Request $request)
    {
        $preAdmission = AppointmentPreAdmission::where('token', $token)
            ->first();

        if ($preAdmission == null) {
            return response()->json(
                [
                    'message'   => 'Appointment Pre Admission',
                    'data'      => null,
                ],
                Response::HTTP_OK
            );
        }

        $appointment = $preAdmission->appointment;
        $patient = $appointment->patient();

        $date_of_birth = $request->date_of_birth;
        $last_name = $request->last_name;

        if ($patient->date_of_birth != $date_of_birth
            || strtolower($patient->last_name) != strtolower($last_name)
        ) {
            $data = $preAdmission->getAppointmentPreAdmissionData();

            return response()->json(
                [
                    'message'   => 'Credential is not correct',
                    'data'      => $data,
                ],
                Response::HTTP_OK
            );
        }

        $preAdmission->status = 'VALIDATED';
        $preAdmission->save();
        $data = $preAdmission->getAppointmentPreAdmissionData();

        return response()->json(
            [
                'message'   => 'Appointment Pre Admission',
                'data'      => $data,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Create Pre Admission
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentPreAdmissionRequest $request, $token)
    {
        $preAdmission = AppointmentPreAdmission::where('token', $token)->get();

        if ($preAdmission == null) {
            return response()->json(
                [
                    'message'   => 'Appointment Pre Admission',
                    'data'      => null,
                ],
                Response::HTTP_OK
            );
        }

        if ($preAdmission->status != 'VALIDATED') {
            $data = $preAdmission->getAppointmentPreAdmissionData();

            return response()->json(
                [
                    'message'   => 'Appointment Pre Admission',
                    'data'      => $data,
                ],
                Response::HTTP_OK
            );
        }

        $appointment = $preAdmission->appointment;        
        $patient = $appointment->patient();

        Patient::where('id', $appointment->patient_id)->update($request->only($patient->getFillable()));
        
        $data = [
            'title' => 'Pre-admission form: '. $appointment->patient_name->full,
            'date' => date('d/m/Y'),
        ]; 
            
        $pdf = PDF::loadView('pdfs/patientPreAdmissionForm', $data);

        $file_name = 'pre_admission_' . $appointment->id . '_' . time() . '.pdf';
        $file_path = '/files/appointment_pre_admission/' . $file_name;

        Storage::put($file_path, $pdf->output());
        $file_url = url($file_path);
        $preAdmission->pre_admission_file = $file_url;
        $preAdmission->status = 'CREATED';
        $preAdmission->save();

        return response()->json(
            [
                'message'   => 'Appointment Pre Admission',
                'data'      => $data,
            ],
            Response::HTTP_OK
        );
    }

        /**
     * [Pre Admission] - Create Pre Admission
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function testPDF()
    {
        $appointment = Appointment::first();
        $preAdmission = $appointment->preAdmission;
        $patient = Patient::first();
  
        $data = [
            'title' => 'Pre-admission form: '. $appointment->patient_name->full,
            'date' => date('d/m/Y'),
        ]; 
            
        $pdf = PDF::loadView('pdfs/patientPreAdmissionForm', $data);

        $file_name = 'pre_admission_' . $appointment->id . '_' . time() . '.pdf';
        $file_path = '/files/appointment_pre_admission/' . $file_name;

        Storage::put($file_path, $pdf->output());
        $file_url = url($file_path);
        $preAdmission->pre_admission_file = $file_url;
        $preAdmission->status = 'CREATED';
        $preAdmission->save();
     
        return 'Success';
    }

    /**
     * [Pre Admission] - Upload Pre Admission
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, Appointment $appointment) {

        $pre_admission = $appointment->pre_admission;

        if ($file = $request->file('file')) {
            $file_name = 'pre_admission_' . $appointment->id . '_' . time() . '.pdf';
            $file_path = '/' . $file->storeAs('files/appointment_pre_admission', $file_name);
            $pre_admission->pre_admission_file = url($file_path);
            $pre_admission->save();
        }

        return response()->json(
            [
                'message' => 'Pre Admission File Uploaded',
                'data'    => $appointment,
            ],
            Response::HTTP_OK
        );
    }
}
