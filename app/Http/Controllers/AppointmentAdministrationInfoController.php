<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\AppointmentAdministrationInfo;
use App\Http\Requests\AppointmentAdministrationInfoRequest;

class AppointmentAdministrationInfoController extends Controller
{
    /**
     * [AppointmentAdminInfo] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $appointmentAdministrationInfos = AppointmentAdministrationInfo::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Appointment Administration Info List',
                'data' => $appointmentAdministrationInfos,
            ],
            Response::HTTP_OK
        );
    }
    /**
     * [AppointmentAdminInfo] - Store
     *
     * @param  \App\Http\Requests\AppointmentAdministrationInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentAdministrationInfoRequest $request)
    {
        $appointmentAdministrationInfo = AppointmentAdministrationInfo::create([
            'appointment_id' => $request->appointment_id,
        ]);

        return response()->json(
            [
                'message' => 'New Appointment Administration Info created',
                'data' => $appointmentAdministrationInfo,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [AppointmentAdminInfo] - Update
     *
     * @param  \App\Http\Requests\AppointmentAdministrationInfoRequest  $request
     * @param  \App\Models\AppointmentAdministrationInfo  $appointmentAdministrationInfo
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentAdministrationInfoRequest $request,
        AppointmentAdministrationInfo $appointmentAdministrationInfo
    ) {
        $AppointmentAdministrationInfo->update([
            'appointment_id' => $request->appointment_id,
            'note' => $request->note,
            'important_details' => $request->important_details,
            'clinical_alerts' => $request->clinical_alerts,
            'receive_forms' => $request->receive_forms,
            'recurring_appointment' => $request->recurring_appointment,
            'recent_service' => $request->recent_service,
            'outstanding_balance' => $request->outstanding_balance,
            'further_details' => $request->further_details,
            'fax_comment' => $request->fax_comment,
            'anything_should_aware' => $request->anything_should_aware,
            'collecting_person_name' => $request->collecting_person_name,
            'collecting_person_phone' => $request->collecting_person_phone,
            'collecting_person_alternate_contact' =>
                $request->collecting_person_alternate_contact,
        ]);

        return response()->json(
            [
                'message' => 'Appointment Administration Info updated',
                'data' => $AppointmentAdministrationInfo,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [AppointmentAdminInfo] - Destroy
     *
     * @param  \App\Models\AppointmentAdministrationInfo  $appointmentAdministrationInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        AppointmentAdministrationInfo $appointmentAdministrationInfo
    ) {
        $appointmentAdministrationInfo->delete();

        return response()->json(
            [
                'message' => 'Appointment Administration Info Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
