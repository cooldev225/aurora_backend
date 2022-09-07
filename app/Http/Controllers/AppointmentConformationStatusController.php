<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentConformationStatusListRequest;
use App\Http\Requests\AppointmentConformationStatusUpdateRequest;
use App\Models\Appointment;

class AppointmentConformationStatusController extends Controller
{
    /**
     * Display a listing of all appointments per their confirmation_status.
     *
     * @param  \Illuminate\Http\AppointmentConformationStatusListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(AppointmentConformationStatusListRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAll', Appointment::class);

        $appointments = Appointment::
            where('organization_id', auth()->user()->organization_id)
            ->where('confirmation_status', $request->confirmation_status)
            ->when($request->appointment_range == 'FUTURE', function ($query) {
                $query->where('date', '>=', date('Y-m-d'));
            })
            ->when($request->appointment_range == 'PAST', function ($query) {
                $query->where('date', '<=', date('Y-m-d'));
            })
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
     * @param  \Illuminate\Http\AppointmentConformationStatusUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentConformationStatusUpdateRequest $request, Appointment $appointment)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $appointment);
    
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
