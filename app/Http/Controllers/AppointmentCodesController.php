<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentCodesRequest;
use App\Models\Appointment;
use Illuminate\Http\Response;

class AppointmentCodesController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentCodesRequest  $request
     * @param  \App\Models\AppointmentCodes  $appointmentCodes
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentCodesRequest $request, Appointment $appointment)
    {
        $appointment->appointment_codes->update($request->validated());

        return response()->json(
            [
                'message' => 'Appointment codes updated',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }


}
