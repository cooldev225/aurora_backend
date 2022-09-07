<?php

namespace App\Http\Controllers;

use App\Enum\AttendanceStatus;
use Illuminate\Http\Response;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentAttendanceStatusController extends Controller
{
    /**
     * Check In
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkIn(Request $request, Appointment $appointment)
    {
        // Check if the user is authorized to update the associated organization
        $this->authorize('update', $appointment->organization);

        ////////////////////////////////////////////////////////////////////////
        // Update the referral information
        $appointment_referral = $appointment->referral;
        $referral_date = date('Y-m-d', strtotime($request->referral_date));
        $appointment_referral->updateReferralData([
            'referring_doctor_id'   =>  $request->referring_doctor_id,
            'referral_date'         =>  $referral_date,
            'referral_duration'     =>  $request->referral_duration,
        ]);

        ////////////////////////////////////////////////////////////////////////
        // Update the appointment status
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
    public function checkOut(Request $request, Appointment $appointment)
    {
        // Check if the user is authorized to update the associated organization
        $this->authorize('update', $appointment->organization);

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
