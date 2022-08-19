<?php

namespace App\Http\Controllers;

use App\Models\SpecialistClinicRelation;
use App\Http\Requests\SpecialistClinicRelationRequest;

class SpecialistClinicRelationController extends Controller
{
    /**
     * [Specialist Clinic] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * [Specialist Clinic] - Store
     *
     * @param  \App\Http\Requests\SpecialistClinicRelationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialistClinicRelationRequest $request)
    {
        //
    }

    /**
     * [Specialist Clinic] - Update
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
     * [Specialist Clinic] - Destroy
     *
     * @param  \App\Models\SpecialistClinicRelation  $specialistClinicRelation
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialistClinicRelation $specialistClinicRelation)
    {
        //
    }
}
