<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\PatientRequest;
use App\Models\Organization;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * [Patient] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;
        $patients = Organization::find($organization_id)
            ->patients()
            ->get()
            ->toArray();

        return response()->json(
            [
                'message' => 'Patient List',
                'data' => $patients,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Patient] - Show
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $patientInfo = $patient;

        $patientInfo['appointments'] = $patient->appointments()
            ->orderBy('date', 'DESC')
            ->orderBy('start_time', 'DESC')
            ->get();

        return response()->json(
            [
                'message' => 'Patient Detail Info',
                'data' => $patientInfo,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Patient] - Update
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        $patient->update($request->all());

        return response()->json(
            [
                'message' => 'Patient updated',
                'data' => $patient,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Patient] - Destroy
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $organization_id = auth()->user()->organization_id;

        $patient->patientOrganization($organization_id)->delete();

        return response()->json(
            [
                'message' => 'Patient Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * [Patient] - Appointment List
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function appointments(Patient $patient) {
        $appointments = [
            'patientId' => $patient->id,
            'pastAppointments' => $patient->five_previous_appointments,
            'futureAppointments' => $patient->all_upcoming_appointments,
        ];
        
        return response()->json(
            [
                'message' => 'Appointment List',
                'data' => $appointments,
            ],
            Response::HTTP_OK
        );
    }
}
