<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentDetailsRequest;
use App\Models\Appointment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AppointmentDetailsController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentDetailsRequest  $request
     * @param  \App\Models\AppointmentDetails  $AppointmentDetails
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentDetailsRequest $request, Appointment $appointment)
    {
        Log::info($request->validated());
        $appointment->detail->update([...$request->validated()]);

        return response()->json(
            [
                'message' => 'Appointment details updated',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }


}
