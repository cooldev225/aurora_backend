<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentReferralRequest;
use App\Models\Appointment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

use App\Http\Constants\FileType;

use App\Http\Controllers\Utils\FileUtil;

class AppointmentReferralController extends Controller
{

    /**
     * [Referral] - Update
     *
     * @group Appointments
     * @param  \App\Http\Requests\AppointmentReferralRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentReferralRequest $request, Appointment $appointment
    ) {

        $appointmentReferral = $appointment->referral()->first();

        $appointmentReferral->update([
            'referring_doctor_id'   => $request->referring_doctor_id,
            'referral_date'         =>  date('Y-m-d', strtotime($request->referral_date)),
            'referral_duration'     => $request->referral_duration,
            'referral_expiry_date'  =>  date("Y-m-d", strtotime("+" . $request->referral_duration . " months", strtotime($request->referral_date))),
        ]);

        if ($file = $request->file('file')) {

            $path = FileUtil::getStoragePath(FileType::$ReferralFile);

            $file_name = FileUtil::getStoragePath(FileType::$ReferralFile, $appointmentReferral->id, $file->extension());

            $file->storeAs($path, $file_name);

            Log::info('PATH: $referral_file_path');
            $appointmentReferral->referral_file = $file_name;
            $appointmentReferral->save();
        }


        return response()->json(
            [
                'message'   => 'Appointment Referral Info updated',
                'data'      => $appointmentReferral,
            ],
            Response::HTTP_OK
        );
    }
}
