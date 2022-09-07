<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Specialist;
use App\Models\AppointmentTimeRequirement;

class AppointmentSearchAvailableController extends Controller
{

    /**
     * [Appointment] - Search Available
     *
     * @group Appointments
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @urlParam clinic_id           A Clinic id.                                Example: 1
     * @urlParam x_weeks             Number of weeks on the future to search.    Example: 2
     * @urlParam specialist_id       A Specialist user Id.                            Example: 16
     * @urlParam appointment_type_id An Appointment Type id.                     Example: 3
     * @urlParam time_requirement    A Time Requirement Id.                      Example: 4
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Return a week long list of available appointment slots within the given parameters

        return response()->json(
            ['message' => 'METHOD NOT IMPLEMENTED'],
            Response::HTTP_OK
        );
    }

}
