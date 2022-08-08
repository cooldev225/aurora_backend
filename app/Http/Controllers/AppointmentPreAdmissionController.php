<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPreAdmissionRequest;
use App\Models\AppointmentPreAdmission;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
            || $patient->last_name != $last_name
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

        if ($file = $request->file('pre_admission')) {
            $file_name = 'pre_admission_' . $preAdmission->id . '_' . time() . '.' . $file->extension();
            $pre_admission_path = '/' . $file->storeAs('files/appointment_pre_admission', $file_name);
            $preAdmission->pre_admission_file = $pre_admission_path;
            $preAdmission->save();
        }

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
