<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentDetailRequest;
use App\Models\Appointment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AppointmentDetailController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentDetailRequest  $request
     * @param  \App\Models\AppointmentDetail  $AppointmentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentDetailRequest $request, Appointment $appointment)
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