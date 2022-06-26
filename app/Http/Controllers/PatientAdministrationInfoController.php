<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\PatientAdministrationInfo;
use App\Http\Requests\PatientAdministrationInfoRequest;

class PatientAdministrationInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $patientAdministrationInfos = PatientAdministrationInfo::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Patient Administration Info List',
                'data' => $patientAdministrationInfos,
            ],
            Response::HTTP_OK
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientAdministrationInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientAdministrationInfoRequest $request)
    {
        $patientAdministrationInfo = PatientAdministrationInfo::create([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'referring_doctor_id' => $request->referring_doctor_id,
            'is_no_referral' => $request->is_no_referral,
            'no_referral_reason' => $request->no_referral_reason,
            'referal_date' => $request->referal_date,
            'referal_expiry_date' => $request->referal_expiry_date,
            'note' => $request->note,
            'important_details' => $request->important_details,
            'allergies' => $request->allergies,
            'clinical_alerts' => $request->clinical_alerts,
            'appointment_confirm' => $request->appointment_confirm,
            'receive_forms' => $request->receive_forms,
            'recurring_appointment' => $request->recurring_appointment,
            'preferred_contact_method' => $request->preferred_contact_method,
            'aborginality' => $request->aborginality,
            'occupation' => $request->occupation,
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
                'message' => 'New Patient Administration Info created',
                'data' => $patientAdministrationInfo,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatientAdministrationInfoRequest  $request
     * @param  \App\Models\PatientAdministrationInfo  $patientAdministrationInfo
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientAdministrationInfoRequest $request,
        PatientAdministrationInfo $patientAdministrationInfo
    ) {
        $PatientAdministrationInfo->update([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'referring_doctor_id' => $request->referring_doctor_id,
            'is_no_referral' => $request->is_no_referral,
            'no_referral_reason' => $request->no_referral_reason,
            'referal_date' => $request->referal_date,
            'referal_expiry_date' => $request->referal_expiry_date,
            'note' => $request->note,
            'important_details' => $request->important_details,
            'allergies' => $request->allergies,
            'clinical_alerts' => $request->clinical_alerts,
            'appointment_confirm' => $request->appointment_confirm,
            'receive_forms' => $request->receive_forms,
            'recurring_appointment' => $request->recurring_appointment,
            'preferred_contact_method' => $request->preferred_contact_method,
            'aborginality' => $request->aborginality,
            'occupation' => $request->occupation,
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
                'message' => 'Patient Administration Info updated',
                'data' => $PatientAdministrationInfo,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientAdministrationInfo  $patientAdministrationInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        PatientAdministrationInfo $patientAdministrationInfo
    ) {
        $patientAdministrationInfo->delete();

        return response()->json(
            [
                'message' => 'Patient Appointment Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
