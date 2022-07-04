<?php

namespace App\Http\Controllers;

use App\Models\SpecialistClinicRelation;
use App\Http\Requests\SpecialistClinicRelationRequest;

class SpecialistClinicRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SpecialistClinicRelationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialistClinicRelationRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SpecialistClinicRelationRequest  $request
     * @param  \App\Models\SpecialistClinicRelation  $specialistClinicRelation
     * @return \Illuminate\Http\Response
     */
    public function update(
        SpecialistClinicRelationRequest $request,
        SpecialistClinicRelation $specialistClinicRelation
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialistClinicRelation  $specialistClinicRelation
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialistClinicRelation $specialistClinicRelation)
    {
        //
    }
}
