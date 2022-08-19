<?php

namespace App\Http\Controllers;

use App\Models\PatientOrganization;
use App\Http\Requests\PatientOrganizationRequest;

class PatientOrganizationController extends Controller
{
    /**
     * [Patient Organization] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientOrganization = PatientOrganization::all();

        return response()->json(
            [
                'message' => 'Patient Organization List',
                'data' => $patientOrganization,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Patient Organization] - Store
     *
     * @param  \App\Http\Requests\PatientOrganizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientOrganizationRequest $request)
    {
        $patientOrganization = PatientOrganization::create([
            'patient_id' => $request->patient_id,
            'organization_id' => $request->organization_id,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Organization created',
                'data' => $patientOrganization,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Patient Organization] - Update
     *
     * @param  \App\Http\Requests\PatientOrganizationRequest  $request
     * @param  \App\Models\PatientOrganization  $patientOrganization
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientOrganizationRequest $request,
        PatientOrganization $patientOrganization
    ) {
        $patientOrganization->update([
            'patient_id' => $request->patient_id,
            'organization_id' => $request->organization_id,
        ]);

        return response()->json(
            [
                'message' => 'Patient Organization updated',
                'data' => $patientOrganization,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Patient Organization] - Destroy
     *
     * @param  \App\Models\PatientOrganization  $patientOrganization
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientOrganization $patientOrganization)
    {
        $patientOrganization->delete();

        return response()->json(
            [
                'message' => 'Patient Organization Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
