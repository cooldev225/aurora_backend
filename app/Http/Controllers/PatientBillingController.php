<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\PatientBilling;
use App\Http\Requests\PatientBillingRequest;

class PatientBillingController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientBillingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientBillingRequest $request)
    {
        $patientBilling = PatientBilling::create([
            'patient_id' => $request->patient_id,
            'charge_type' => $request->charge_type,
            'medicare_number' => $request->medicare_number,
            'medicare_expiry_date' => $request->medicare_expiry_date,
            'concession_number' => $request->concession_number,
            'concession_expiry_date' => $request->concession_expiry_date,
            'pension_number' => $request->pension_number,
            'pension_expiry_date' => $request->pension_expiry_date,
            'healthcare_card_number' => $request->healthcare_card_number,
            'healthcare_card_expiry_date' =>
                $request->healthcare_card_expiry_date,
            'health_fund_id' => $request->health_fund_id,
            'health_fund_membership_number' =>
                $request->health_fund_membership_number,
            'health_fund_card_expiry_date' =>
                $request->health_fund_card_expiry_date,
            'fund_excess' => $request->fund_excess,
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
     * Update the specified resource in storage.
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
            'patient_id' => $request->patient_id,
            'charge_type' => $request->charge_type,
            'medicare_number' => $request->medicare_number,
            'medicare_expiry_date' => $request->medicare_expiry_date,
            'concession_number' => $request->concession_number,
            'concession_expiry_date' => $request->concession_expiry_date,
            'pension_number' => $request->pension_number,
            'pension_expiry_date' => $request->pension_expiry_date,
            'healthcare_card_number' => $request->healthcare_card_number,
            'healthcare_card_expiry_date' =>
                $request->healthcare_card_expiry_date,
            'health_fund_id' => $request->health_fund_id,
            'health_fund_membership_number' =>
                $request->health_fund_membership_number,
            'health_fund_card_expiry_date' =>
                $request->health_fund_card_expiry_date,
            'fund_excess' => $request->fund_excess,
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
     * Remove the specified resource from storage.
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
