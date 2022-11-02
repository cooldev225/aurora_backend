<?php

namespace App\Http\Controllers;

use App\Models\PatientAllergy;
use App\Http\Requests\PatientAllergyRequest;
use Illuminate\Http\Response;

class PatientAllergyController extends Controller
{
    /**
     * [Allergies] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', PatientAllergy::class);

        $result = PatientAllergy::all();

        return response()->json(
            [
                'message' => 'Allergies List',
                'data' => $result,
            ],
            Response::HTTP_OK
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatientAllergyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientAllergyRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientAllergyRequest  $request
     * @param  \App\Models\PatientAllergy  $patientAllergy
     * @return \Illuminate\Http\Response
     */
    public function update(PatientAllergyRequest $request, PatientAllergy $patientAllergy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientAllergy  $patientAllergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientAllergy $patientAllergy)
    {
        //
    }
}
