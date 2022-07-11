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
        $patients = Patient::organizationPatientsBasicInfo()
            ->get()
            ->toArray();

        $appointments = Appointment::organizationAppointmentsWithType()
            ->orderBy('date')
            ->get()
            ->toArray();

        $today = date('Y-m-d');

        foreach ($patients as $key => $patient) {
            $patients[$key]['upcoming_appointment'] = [];
            $is_current_appointment = false;

            foreach ($appointments as $appointment) {
                if ($appointment['patient_id'] == $patient['id']) {
                    if (
                        strtoupper($appointment['confirmation_status']) != 'CANCELED'
                    ) {
                      
                        if ($appointment['date'] >= $today) {
                            if ($is_current_appointment == false) {
                                $is_current_appointment = true;
                            } elseif (
                                empty($patients[$key]['upcoming_appointment'])
                            ) {
                                $patients[$key][
                                    'upcoming_appointment'
                                ] = $appointment;
                            }
                        }
                    }
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
     * Display a item of the Patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $today = date('Y-m-d');

        $patientInfo = Patient::patientDetailInfo($patient->id)
            ->get()
            ->toArray();

        $patientInfo['canceled_appointments'] = 0;
        $patientInfo['missed_appointments'] = 0;
        $patientInfo['future_appointments'] = 0;
        $patientInfo['past_appointments'] = [];
        $patientInfo['current_appointment'] = [];
        $patientInfo['upcoming_appointment'] = [];

        $appointments = $patient->appointments;

        foreach ($appointments as $appointment) {
            if (
                strtoupper($appointment->confirmation_status) ==
                'CANCELED'
            ) {
                $patientInfo['canceled_appointments']++;
            } elseif ($appointment->date >= $today) {
                if (empty($patientInfo['current_appointment'])) {
                    $patientInfo[
                        'current_appointment'
                    ] = $appointment;
                } elseif (
                    empty($patientInfo['upcoming_appointment'])
                ) {
                    $patientInfo[
                        'upcoming_appointment'
                    ] = $appointment;
                } else {
                    $patientInfo['future_appointments']++;
                }
            } elseif ($appointment->date < $today) {
                $patientInfo['past_appointments'][] = [
                    'date' => $appointment->date,
                    'procedure_name' => $appointment->procedure_name,
                    'color' => $appointment->color,
                ];

                if (
                    strtoupper($appointment->confirmation_status) ==
                    'MISSED'
                ) {
                    $patientInfo['missed_appointments']++;
                }
            }
        }

        return response()->json(
            [
                'message' => 'Patient Detail Info',
                'data' => $patientInfo,
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
