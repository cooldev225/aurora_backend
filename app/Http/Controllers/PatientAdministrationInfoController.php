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
        //
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
