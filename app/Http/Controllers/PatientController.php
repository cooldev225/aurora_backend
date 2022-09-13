<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\PatientRequest;
use App\Models\Appointment;
use App\Models\Organization;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * [Patient] - List
     *
     * Returns a lists of all patients 
     * 
     * @group Patients
     * @responseFile storage/responses/patients.show.json
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Patient::class);

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
     * @param  \App\Models\Patient  $patient
     * @responseFile storage/responses/patients.show.json
     */
    public function show(Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('view', $patient);

        $organization_id = auth()->user()->organization_id;

        $patientInfo = $patient;

        $patientInfo['appointments'] = $patient->appointments()
            ->where('organization_id', $organization_id)
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
     * @group Patients
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $patient);

        $patient->update($request->verified());

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
     * @param  \App\Models\Patient  $patient
     * @responseFile storage/responses/patients.appointments.json
     */
    public function appointments(Patient $patient) {
        // Verify the user can access this function via policy
        $this->authorize('view', $patient);
        $this->authorize('viewAny', Appointment::class);

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
