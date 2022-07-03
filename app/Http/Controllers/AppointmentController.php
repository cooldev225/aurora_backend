<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Procedure;
use App\Models\Specialist;
use App\Models\Room;
use App\Models\PatientBilling;
use App\Models\AppointmentAdministrationInfo;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient_table = (new Patient())->getTable();
        $clinic_table = (new Clinic())->getTable();
        $appointment_type_table = (new AppointmentType())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $room_table = (new Room())->getTable();

        $appointmentList = Appointment::leftJoin(
            $patient_table,
            'patient_id',
            '=',
            $patient_table . '.id'
        )
            ->leftJoin($clinic_table, 'clinic_id', '=', $clinic_table . '.id')
            ->leftJoin(
                $appointment_type_table,
                'appointment_type_id',
                '=',
                $appointment_type_table . '.id'
            )
            ->leftJoin(
                $specialist_table,
                'primary_pathologist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin(
                $specialist_table,
                'specialist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin(
                $specialist_table,
                'anesthetist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin($room_table, 'room_id', '=', $room_table . '.id')
            ->where('organization_id', auth()->user()->organization_id);

        $appointments = [];

        if ($request->has('clinic_id')) {
            $appointments = $appointmentList
                ->where('clinic_id', $request->input('clinic_id'))
                ->get();
        } else {
            $appointments = $appointmentList->get();
        }

        return response()->json(
            [
                'message' => 'Appointment List',
                'data' => $appointments,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $patient = Patient::where('email', $request->email)->first();

        if (empty($patient)) {
            $patient = Patient::create([
                'UR_number' => $request->UR_number,
                'title' => $request->title,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'home_number' => $request->home_number,
                'work_number' => $request->work_number,
                'mobile_number' => $request->mobile_number,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'street' => $request->street,
                'city' => $request->suburb,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'country' => $request->country,
                'marital_status' => $request->marital_status,
                'birth_place_code' => $request->birth_place_code,
                'country_of_birth' => $request->country_of_birth,
                'birth_state' => $request->birth_state,
                'allergies' => $request->allergies,
                'aborginality' => $request->aborginality,
                'occupation' => $request->occupation,
                'height' => $request->height,
                'weight' => $request->weight,
                'bmi' => $request->bmi,
                'preferred_contact_method' =>
                    $request->preferred_contact_method,
                'appointment_confirm_method' =>
                    $request->appointment_confirm_method,
            ]);
        }

        $patientBilling = $patient->billing();

        if (empty($patientBilling)) {
            $patientBilling = PatientBilling::create([
                'patient_id' => $patient->id,
                'charge_type' => $request->charge_type,
                'medicare_number' => $request->medicare_number,
                'medicare_expiry_date' => $request->medicare_expiry_date,
                'concession_number' => $request->concession_number,
                'concession_expiry_date' => $request->concession_expiry_date,
                'pension_number' => $request->pension_number,
                'pension_expiry_date' => $request->pension_expiry_date,
                'healthcare_card_number' => $request->healthcare_card_number,
                'healthcare_card_expiry_date' =>
                    $request->healthcare_card_expiry_date,
                'health_fund_id' => $request->health_fund_id,
                'health_fund_membership_number' =>
                    $request->health_fund_membership_number,
                'health_fund_card_expiry_date' =>
                    $request->health_fund_card_expiry_date,
                'fund_excess' => $request->fund_excess,
            ]);
        }

        $start_time = date('H:i:s', strtotime($request->time_slot[0]));
        $end_time = date('H:i:s', strtotime($request->time_slot[1]));

        $anesthetic_answers = $request->anesthetic_questions
            ? $request->anesthetic_answers
            : [];
        $procedure_answers = $request->procedure_questions
            ? $request->procedure_answers
            : [];

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
            'clinic_id' => $request->clinic_id,
            'appointment_type_id' => $request->appointment_type_id,
            'primary_pathologist_id' => $request->input(
                'primary_pathologist_id',
                0
            ),
            'specialist_id' => $request->specialist_id,
            'anesthetist_id' => $request->anesthetist_id,
            'room_id' => $request->room_id,
            'reference_number' => $request->reference_number,
            'date' => $request->date,
            'arrival_time' => $request->arrival_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'actual_arrival_time' => $request->actual_arrival_time,
            'actual_start_time' => $request->actual_start_time,
            'actual_end_time' => $request->actual_end_time,
            'charge_type' => $request->charge_type,
            'is_waitlisted' => $request->is_waitlisted,
            'skip_coding' => $request->skip_coding,
            'anesthetic_answers' => json_encode($appointment_answers),
            'procedure_answers' => json_encode($procedure_answers),
        ]);

        $appointmentAdministrationInfo = AppointmentAdministrationInfo::create([
            'appointment_id' => $appointment->id,
            'referring_doctor_id' => $request->referring_doctor_id,
            'is_no_referral' => $request->is_no_referral,
            'no_referral_reason' => $request->no_referral_reason,
            'referral_date' => $request->referral_date,
            'referral_expiry_date' => $request->referral_expiry_date,
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
                'message' => 'New Appointment created',
                'data' => $appointment,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentRequest $request,
        Appointment $appointment
    ) {
        $organization_id = auth()->user()->organization_id;

        $patient = $appointment->patient();

        $patient->update([
            'UR_number' => $request->UR_number,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'home_number' => $request->home_number,
            'work_number' => $request->work_number,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->suburb,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
            'marital_status' => $request->marital_status,
            'birth_place_code' => $request->birth_place_code,
            'country_of_birth' => $request->country_of_birth,
            'birth_state' => $request->birth_state,
            'allergies' => $request->allergies,
            'aborginality' => $request->aborginality,
            'occupation' => $request->occupation,
            'height' => $request->height,
            'weight' => $request->weight,
            'bmi' => $request->bmi,
            'preferred_contact_method' => $request->preferred_contact_method,
            'appointment_confirm_method' =>
                $request->appointment_confirm_method,
        ]);

        $patientBilling = $patient->billing();

        $patientBilling->update([
            'patient_id' => $patient->id,
            'charge_type' => $request->charge_type,
            'medicare_number' => $request->medicare_number,
            'medicare_expiry_date' => $request->medicare_expiry_date,
            'concession_number' => $request->concession_number,
            'concession_expiry_date' => $request->concession_expiry_date,
            'pension_number' => $request->pension_number,
            'pension_expiry_date' => $request->pension_expiry_date,
            'healthcare_card_number' => $request->healthcare_card_number,
            'healthcare_card_expiry_date' =>
                $request->healthcare_card_expiry_date,
            'health_fund_id' => $request->health_fund_id,
            'health_fund_membership_number' =>
                $request->health_fund_membership_number,
            'health_fund_card_expiry_date' =>
                $request->health_fund_card_expiry_date,
            'fund_excess' => $request->fund_excess,
        ]);

        $start_time = date('H:i:s', strtotime($request->time_slot[0]));
        $end_time = date('H:i:s', strtotime($request->time_slot[1]));

        $anesthetic_answers = $request->anesthetic_questions
            ? $request->anesthetic_answers
            : [];
        $procedure_answers = $request->procedure_questions
            ? $request->procedure_answers
            : [];

        $appointment->update([
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
            'clinic_id' => $request->clinic_id,
            'appointment_type_id' => $request->appointment_type_id,
            'primary_pathologist_id' => $request->input(
                'primary_pathologist_id',
                0
            ),
            'specialist_id' => $request->specialist_id,
            'anesthetist_id' => $request->anesthetist_id,
            'room_id' => $request->room_id,
            'reference_number' => $request->reference_number,
            'date' => $request->date,
            'arrival_time' => $request->arrival_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'actual_arrival_time' => $request->actual_arrival_time,
            'actual_start_time' => $request->actual_start_time,
            'actual_end_time' => $request->actual_end_time,
            'charge_type' => $request->charge_type,
            'is_waitlisted' => $request->is_waitlisted,
            'skip_coding' => $request->skip_coding,
            'anesthetic_answers' => json_encode($appointment_answers),
            'procedure_answers' => json_encode($procedure_answers),
        ]);

        $appointmentAdministrationInfo = $appointment->administrationInfo();

        $appointmentAdministrationInfo->update([
            'appointment_id' => $appointment->id,
            'referring_doctor_id' => $request->referring_doctor_id,
            'is_no_referral' => $request->is_no_referral,
            'no_referral_reason' => $request->no_referral_reason,
            'referral_date' => $request->referral_date,
            'referral_expiry_date' => $request->referral_expiry_date,
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
                'message' => 'Appointment updated',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json(
            [
                'message' => 'Appointment Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
