<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientIndexRequest;
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
    public function index(PatientIndexRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Patient::class);

        $params = $request->validated();

        $patients = Organization::find(auth()->user()->organization_id)
            ->patients();

        foreach ($params as $column => $param) {
            if (!empty($param)) {
                $patients = $patients->where($column, '=', $param);
            }
        }

        $patients = $patients->get()->toArray();

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


        return response()->json(
            [
                'message' => 'Patient Detail Info',
                'data' =>  $patient
                    ->load('allergies')
                    ->load('appointments'),
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

        $patient->update($request->validated());

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
    public function appointments(Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('view', $patient);
        $this->authorize('viewAny', Appointment::class);

        $organization_id = auth()->user()->organization_id;

        $appointments = [
            'patientId' => $patient->id,
            'pastAppointments' => $patient->appointments()
                ->where('date', '<', date('Y-m-d'))
                ->take(5)
                ->get(),
            'futureAppointments' => $patient->appointments()
            ->where('date', '>=', date('Y-m-d'))
            ->get(),
            'appointment_count' => $patient->appointments->count(),
            'cancelled_appointment_count' => $patient->appointments->where('confirmation_status', 'CANCELED')->count(),
            'missed_appointment_count' => $patient->appointments->where('confirmation_status', 'MISSED')->count(),
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
