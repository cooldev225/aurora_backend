<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Patient;
use App\Models\PatientAlsoKnownAs;
use App\Http\Requests\PatientAlsoKnownAsStoreRequest;
use App\Http\Requests\PatientAlsoKnownAsUpdateRequest;
use App\Http\Requests\PatientAlsoKnownAsBulkRequest;

class PatientAlsoKnownAsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientAlsoKnownAsStoreRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientBilling::class);

        $existingAka = PatientAlsoKnownAs::wherePatientId($request->patient_id)
                                         ->whereFirstName($request->first_name)
                                         ->whereLastName($request->last_name)
                                         ->first();

        if ($existingAka) {
            return response()->json(
                [
                    'message' => 'Patient Also Known As already exists',
                    'data' => $existingAka,
                ],
                Response::HTTP_OK
            );
        }

        $patientAlsoKnownAs = PatientAlsoKnownAs::create($request->validated());

        return response()->json(
            [
                'message' => 'Patient Also Known As created',
                'data' => $patientAlsoKnownAs,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientAlsoKnownAsUpdateRequest $request, PatientAlsoKnownAs $patientAlsoKnownAs)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $patientAlsoKnownAs);

        $patientAlsoKnownAs->update($request->validated());

        return response()->json(
            [
                'message' => 'Patient Also Known As updated',
                'data' => $patientAlsoKnownAs,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientAlsoKnownAs $patientAlsoKnownAs)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $patientAlsoKnownAs);

        $patientAlsoKnownAs->delete();

        return response()->json(
            [
                'message' => 'Patient Also Known As deleted',
                'data' => $patientAlsoKnownAs,
            ],
            Response::HTTP_OK
        );
    }

    public function bulk(Patient $patient, PatientAlsoKnownAsBulkRequest $patientAlsoKnownAsList)
    {
        return $patientAlsoKnownAsList->validated();
    }
}
