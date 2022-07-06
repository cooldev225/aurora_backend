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
            ->get()
            ->toArray();

        foreach ($patients as $key => $patient) {
            $patients[$key]['appointments'] = [];

            foreach ($appointments as $appointment) {
                if ($appointment['patient_id'] == $patient['id']) {
                    $patients[$key]['appointments'][] = $appointment;
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
        $patient = Patient::create([
            'UR_number' => $request->UR_number,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
            'marital_status' => $request->marital_status,
            'birth_place_code' => $request->birth_place_code,
            'country_of_birth' => $request->country_of_birth,
            'birth_state' => $request->birth_state,
            'allergies' => $request->allergies,
            'aborginality' => $request->aborginality,
            'occupation' => $request->occupation,
            'height' => $request->height,
            'weight' => $request->weight,
            'bmi' => $request->bmi,
            'preferred_contact_method' => $request->preferred_contact_method,
            'appointment_confirm_method' =>
                $request->appointment_confirm_method,
            'send_recall_method' => $request->send_recall_method,
        ]);

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
        $patient->update([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
            'marital_status' => $request->marital_status,
            'birth_place_code' => $request->birth_place_code,
            'country_of_birth' => $request->country_of_birth,
            'birth_state' => $request->birth_state,
            'allergies' => $request->allergies,
            'aborginality' => $request->aborginality,
            'occupation' => $request->occupation,
            'height' => $request->height,
            'weight' => $request->weight,
            'bmi' => $request->bmi,
            'preferred_contact_method' => $request->preferred_contact_method,
            'appointment_confirm_method' =>
                $request->appointment_confirm_method,
            'send_recall_method' => $request->send_recall_method,
        ]);

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
