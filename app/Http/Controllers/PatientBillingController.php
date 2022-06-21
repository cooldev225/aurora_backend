<?php

namespace App\Http\Controllers;

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
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientBillingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientBillingRequest $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientBilling $patientBilling)
    {
        //
    }
}
