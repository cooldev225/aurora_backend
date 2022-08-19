<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\PatientBilling;
use App\Http\Requests\PatientBillingRequest;

class PatientBillingController extends Controller
{
    /**
     * [Patient Billing] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $patientBillings = PatientBilling::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Patient Billing List',
                'data' => $patientBillings,
            ],
            Response::HTTP_OK
        );
    }
    /**
     * [Patient Billing] - Store
     *
     * @param  \App\Http\Requests\PatientBillingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientBillingRequest $request)
    {
        $patientBilling = PatientBilling::create([
            ...$request->all(),
            'patient_id' => $request->☻patient_id,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Billing created',
                'data' => $patientBilling,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Patient Billing] - Update
     *
     * @param  \App\Http\Requests\PatientBillingRequest  $request
     * @param  \App\Models\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientBillingRequest $request,
        PatientBilling $patientBilling
    ) {
        $patientBilling->update([
            ...$request->all(),
            'patient_id' => $request->☻patient_id,
        ]);

        return response()->json(
            [
                'message' => 'Patient Billing updated',
                'data' => $patientBilling,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Patient Billing] - Destroy
     *
     * @param  \App\Models\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientBilling $patientBilling)
    {
        $patientBilling->delete();

        return response()->json(
            [
                'message' => 'Patient Appointment Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
