<?php

namespace App\Http\Controllers;

use App\Models\AppointmentCodes;
use App\Http\Requests\StoreAppointmentCodesRequest;
use App\Http\Requests\UpdateAppointmentCodesRequest;

class AppointmentCodesController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentCodesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentCodesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentCodes  $appointmentCodes
     * @return \Illuminate\Http\Response
     */
    public function show(AppointmentCodes $appointmentCodes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppointmentCodes  $appointmentCodes
     * @return \Illuminate\Http\Response
     */
    public function edit(AppointmentCodes $appointmentCodes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentCodesRequest  $request
     * @param  \App\Models\AppointmentCodes  $appointmentCodes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentCodesRequest $request, AppointmentCodes $appointmentCodes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentCodes  $appointmentCodes
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentCodes $appointmentCodes)
    {
        //
    }
}
