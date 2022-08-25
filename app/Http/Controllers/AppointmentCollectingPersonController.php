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

        $appointment->update([
            'collecting_person_name'                 => $request->collecting_person_name,
            'collecting_person_phone'                => $request->collecting_person_phone,
            'collecting_person_alternate_contact'    => $request->collecting_person_alternate_contact,
        ]);

        return response()->json(
            [
                'message' => 'Collecting Person Info Updated',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }
}
