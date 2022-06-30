<?php

namespace App\Http\Controllers;

use App\Models\AppointmentType;
use App\Http\Requests\AppointmentTypeRequest;

class AppointmentTypeController extends Controller
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
     * @param  \App\Http\Requests\AppointmentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentTypeRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentTypeRequest  $request
     * @param  \App\Models\AppointmentType  $appointmentType
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentTypeRequest $request,
        AppointmentType $appointmentType
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentType  $appointmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentType $appointmentType)
    {
        //
    }
}
