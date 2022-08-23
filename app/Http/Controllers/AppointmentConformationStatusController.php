<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentConformationStatusRequest;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentConformationStatusController extends BaseOrganizationController
{
    /**
     * Display a listing of all appointments per their confirmation_status.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $appointments = Appointment::
            where('organization_id', auth()->user()->organization_id)
            ->where('confirmation_status', $request->confirmation_status)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return response()->json(
            [
                'message' => 'Appointment where confirmation_status = '. $request->confirmation_status,
                'data' => $appointments,
            ],
            200
        );
    }


    /**
     * Updated the Appointment 'confirmation_status' along with the reason for the status
     *
     * @param  \Illuminate\Http\AppointmentConformationStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentConformationStatusRequest $request, Appointment $appointment)
    {

    
        $appointment->confirmation_status = $request->confirmation_status;
        $appointment->confirmation_status_reason = $request->confirmation_status_reason;
        $appointment->save();

        return response()->json(
            [
                'message' => 'Appointment confirmation status updated',
                'data' => $appointment,
            ],
            200
        );
    }
}
