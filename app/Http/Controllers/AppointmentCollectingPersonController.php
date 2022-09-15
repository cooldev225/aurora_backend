<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentCollectingPersonRequest;
use App\Models\Appointment;
use Illuminate\Http\Response;

class AppointmentCollectingPersonController extends Controller
{

    /**
     * [Collecting Person] - Update
     *
     * @group Appointments
     * @param  \App\Http\Requests\AppointmentCollectingPersonRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentCollectingPersonRequest $request, Appointment $appointment
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $appointment);

        $appointment->update($request->validated());

        return response()->json(
            [
                'message' => 'Collecting Person Info Updated',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }
}
