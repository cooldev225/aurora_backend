<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentConfirmationStatusListRequest;
use App\Http\Requests\AppointmentConfirmationStatusUpdateRequest;
use App\Models\Appointment;

class AppointmentConfirmationStatusController extends Controller
{
    /**
     * Display a listing of all appointments per their confirmation_status.
     *
     * @param  \Illuminate\Http\AppointmentConfirmationStatusListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(AppointmentConfirmationStatusListRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Appointment::class);

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
     * @param  \Illuminate\Http\AppointmentConfirmationStatusUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentConfirmationStatusUpdateRequest $request, Appointment $appointment)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $appointment);
    
        $appointment->update($request->validated());

        return response()->json(
            [
                'message' => 'Appointment confirmation status updated',
                'data' => $appointment,
            ],
            200
        );
    }
}
