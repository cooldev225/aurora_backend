<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\PatientBilling;
use App\Http\Requests\PatientBillingRequest;
use App\Models\Patient;

class PatientBillingController extends Controller
{
    /**
     * [Patient Billing] - Update
     *
     * @param  \App\Http\Requests\PatientBillingRequest  $request
     * @param  \App\Models\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientBillingRequest $request,
        Patient $patient
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $patient);

        $patient->patientBilling->update([
            'patient_id' => $patient->patient_id,
            ...$request->all(),
          
        ]);

        return response()->json(
            [
                'message' => 'Patient Billing updated',
                'data' => $patient,
            ],
            Response::HTTP_OK
        );
    }
}
