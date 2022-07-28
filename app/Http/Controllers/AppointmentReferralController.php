<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentReferralRequest;
use App\Models\AppointmentReferral;
use Illuminate\Http\Response;

class AppointmentReferralController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentReferralRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentReferralRequest $request
    ) {
        $appointmentReferral = AppointmentReferral::where('appointment_id', $request->id)
            ->first();

        $referral_date = $request->referral_date;
        $referral_duration = $request->referral_duration;
        $referral_expiry_date = date(
            "Y-m-d",
            strtotime("+" . $referral_duration . " months", strtotime($referral_date))
        );
    
        $appointmentReferral->update([
            ...$request->all(),
            'referral_expiry_date'  =>  $referral_expiry_date
        ]);

        $appointmentReferral = AppointmentReferral::where('appointment_id', $request->id)
            ->first();

        return response()->json(
            [
                'message'   => 'Appointment Referral Info updated',
                'data'      => $appointmentReferral,
            ],
            Response::HTTP_OK
        );
    }
}
