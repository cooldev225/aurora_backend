<?php

namespace App\Http\Controllers;

use App\Models\PatientAllergy;
use App\Http\Requests\PatientAllergyRequest;

class PatientAllergyController extends Controller
{

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
