<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\PatientOrganization;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $patients = Patient::organizationPatients()
            ->get()
            ->toArray();

        $appointments = Appointment::organizationAppointmentsWithType()
            ->orderByDesc('date')
            ->get()
            ->toArray();

        $today = date('Y-m-d');

        foreach ($patients as $key => $patient) {
            $patients[$key]['canceled_appointments'] = 0;
            $patients[$key]['missed_appointments'] = 0;
            $patients[$key]['future_appointments'] = 0;
            $patients[$key]['past_appointments'] = [];

            foreach ($appointments as $appointment) {
                if ($appointment['patient_id'] == $patient['id']) {
                    if (
                        strtoupper($appointment['confirmation_status']) ==
                        'CANCELED'
                    ) {
                        $patients[$key]['canceled_appointments']++;
                    }

                    if ($appointment['date'] >= $today) {
                        $patients[$key]['current_appointment'] = $appointment;

                        $patients[$key]['future_appointments']++;
                    }

                    if ($appointment['date'] < $today) {
                        $patients[$key]['past_appointments'][] = [
                            'date' => $appointment['date'],
                            'procedure_name' => $appointment['procedure_name'],
                        ];

                        if (
                            strtoupper($appointment['confirmation_status']) ==
                            'MISSED'
                        ) {
                            $patients[$key]['missed_appointments']++;
                        }
                    }

                    $patients[$key]['appointments'][] = $appointment;
                }

                if ($patients[$key]['future_appointments'] > 0) {
                    $patients[$key]['future_appointments']--;
                }
            }
        }

        return response()->json(
            [
                'message' => 'Patient List',
                'data' => $patients,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        $patient = Patient::create($request->all());

        $organization_id = auth()->user()->organization_id;

        $patient = PatientOrganization::create([
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
        ]);

        return response()->json(
            [
                'message' => 'Patient created',
                'data' => $patient,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
}
