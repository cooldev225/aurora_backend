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
     * @group Patients
     * @responseFile storage/responses/patients.show.json
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
     * @group Patients
     * @responseFile storage/responses/patients.show.json
     */
    public function show(Patient $patient)
    {

        $organization_id = auth()->user()->organization_id;
        if ($patient->isPartOfOrganization($organization_id)) {
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

        return response()->json(
            [
                'message' => 'Patient not a part of users organization',
            ],
            Response::HTTP_UNAUTHORIZED
        );

      
    }

    /**
     * [Patient] - Update
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @group Patients
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
     * [Patient] - Appointment History Information
     *
     * @group Patients
     * @responseFile storage/responses/patients.appointments.json
     */
    public function appointments(Patient $patient) {

$organization_id = auth()->user()->organization_id;

        $appointments = [
            'patientId' => $patient->id,
            'pastAppointments' => $patient->appointments()
            ->where('organization_id', $organization_id)
            ->where('date', '<', date('Y-m-d'))
            ->take(5)
            ->get(),
            'futureAppointments' => $patient->all_upcoming_appointments,
            'previousAppointmentCount' => $patient->appointments()
            ->where('organization_id', $organization_id)
            ->where('date','<', date('Y-m-d'))
            ->count()
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
