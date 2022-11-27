<?php

namespace App\Http\Controllers;

use App\Enum\AttendanceStatus;
use Illuminate\Http\Response;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentAttendanceStatusController extends Controller
{
    /**
     * Check In
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkIn(Appointment $appointment)
    {
        // Check if the user is authorized to update the models
        $this->authorize('update', $appointment);

        $appointment->attendance_status = AttendanceStatus::CHECKED_IN;
        $appointment->save();

        return response()->json(
            [
                'message' => 'Appointment Check In',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Check Out
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkOut(Appointment $appointment)
    {
        // Check if the user is authorized to update the models
        $this->authorize('update', $appointment);

        $appointment->attendance_status = AttendanceStatus::CHECKED_OUT;
        $appointment->save();

        return response()->json(
            [
                'message' => 'Appointment Check Out',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }
}
