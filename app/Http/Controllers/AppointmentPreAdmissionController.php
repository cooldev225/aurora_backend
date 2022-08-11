<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPreAdmissionRequest;
use App\Models\AppointmentPreAdmission;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AppointmentPreAdmissionController extends Controller
{
    /**
     * return the appointment pre admission info.
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
     * return the appointment pre admission info.
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
     * return the appointment pre admission info.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function store($token, AppointmentPreAdmissionRequest $request)
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
        Patient::where('id', $appointment->patient_id)
            ->update($request->only($patient->getFillable()));
        
        $pdf = $request->pdf;
        $pdf = str_replace('data:application/pdf;base64,', '', $pdf);
        $pdf = base64_decode($pdf);
        $file_name = 'pre_admission_' . $appointment->id . '_' . time() . '.pdf';
        $file_path = '/files/appointment_pre_admission/' . $file_name;

        Storage::put($file_path, $pdf);
        $preAdmission->pre_admission_file = $file_path;
        $preAdmission->status = 'CREATED';
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
}
