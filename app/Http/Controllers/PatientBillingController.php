<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientBilling;
use App\Http\Requests\PatientBillingStoreRequest;
use App\Http\Requests\PatientBillingUpdateRequest;

class PatientBillingController extends Controller
{
    /**
     * [Patient Billing] - Store
     *
     * @param  \App\Http\Requests\PatientBillingStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientBillingStoreRequest $request) {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientBilling::class);
        
        $concession = $request->safe()->only(['has_medicare_concession']);

        $patient_billing = PatientBilling::create([
            'is_valid'    => true,
            'verified_at' => now(),
            'has_medicare_concession' => $concession['has_medicare_concession'] ?? false,
            ...$request->safe()->except(['has_medicare_concession']),
        ]);

        return response()->json(
            [
                'message' => 'Patient Billing created',
                'data' => $patient_billing,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Patient Billing] - Update
     *
     * @param  \App\Http\Requests\PatientBillingRequest  $request
     * @param  \App\Models\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function update(PatientBillingUpdateRequest $request, PatientBilling $patientBilling) {
        // Verify the user can access this function via policy
        $this->authorize('update', $patientBilling);

        $data = $request->validated();
        if ($data['is_valid']) {
            $data['verified_at'] = now();
        }

        $patientBilling->update($data);

        return response()->json(
            [
                'message' => 'Patient Billing updated',
                'data' => $patientBilling,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Patient Billing] - Delete
     *
     * @param  \App\Models\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function delete(PatientBilling $patientBilling) {
        // Verify the user can access this function via policy
        $this->authorize('delete', $patientBilling);

        $patientBilling->delete();

        return response()->json(
            [
                'message' => 'Patient Billing delete',
                'data' => $patientBilling,
            ],
            Response::HTTP_OK
        );
    }
}
