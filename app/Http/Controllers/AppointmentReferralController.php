<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AppointmentReferralRequest;
use App\Http\Requests\AppointmentReferralFileRequest;

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
        $appointmentReferral = $appointment->referral;

        // Verify the user can access this function via policy
        $this->authorize('update', $appointmentReferral);

        $appointmentReferral->update([
            'doctor_address_book_id'   => $request->doctor_address_book_id,
            'referral_date'         =>  Carbon::create($request->referral_date)->toDateString(),
            'referral_duration'     => $request->referral_duration,
            'referral_expiry_date'  =>  Carbon::create($request->referral_date)->addMonths($request->referral_duration)->toDateString(),
        ]);

        if ($file = $request->file('file')) {
            $file_name = generateFileName(FileType::REFERRAL, $appointmentReferral->id, $file->extension());
            $org_path = getUserOrganizationFilePath();
            
            if (!$org_path) {
                return response()->json(
                    [
                        'message'   => 'Could not find user organization',
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $file_path = "/{$org_path}/{$file_name}";
            Storage::put($file_path, file_get_contents($file));

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
