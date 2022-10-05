<?php

namespace App\Http\Controllers;

use App\Models\AppointmentCodes;
use App\Http\Requests\StoreAppointmentCodesRequest;
use App\Http\Requests\UpdateAppointmentCodesRequest;

class AppointmentCodesController extends Controller
{

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


}
