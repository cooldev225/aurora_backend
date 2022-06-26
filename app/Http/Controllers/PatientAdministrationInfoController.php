<?php

namespace App\Http\Controllers;

use App\Models\PatientAdministrationInfo;
use App\Http\Requests\PatientAdministrationInfoRequest;

class PatientAdministrationInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientAdministrationInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientAdministrationInfoRequest $request)
    {
        $patientAdministrationInfo = PatientAppointment::create([
            'patient_id' => $request->patient_id,
            'organization_id' => $organization_id,
            'clinic_id' => $request->clinic_id,
            'procedure_id' => $request->procedure_id,
            'primary_pathologist_id' => $request->input(
                'primary_pathologist_id',
                0
            ),
            'specialist_id' => $request->specialist_id,
            'anaethetist_id' => $request->anaethetist_id,
            'room_id' => $room->id,
            'reference_number' => $request->reference_number,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'actual_start_time' => $request->actual_start_time,
            'actual_end_time' => $request->actual_end_time,
            'note' => $request->note,
            'important_details' => $request->important_details,
            'allergies' => $request->allergies,
            'clinical_alerts' => $request->clinical_alerts,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Appointment created',
                'data' => $patientAdministrationInfo,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatientAdministrationInfoRequest  $request
     * @param  \App\Models\PatientAdministrationInfo  $patientAdministrationInfo
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientAdministrationInfoRequest $request,
        PatientAdministrationInfo $patientAdministrationInfo
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientAdministrationInfo  $patientAdministrationInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        PatientAdministrationInfo $patientAdministrationInfo
    ) {
        //
    }
}
