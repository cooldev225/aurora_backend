<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Procedure;
use App\Models\Specialist;
use App\Models\Room;
use App\Models\PatientBilling;
use App\Models\AppointmentAdministrationInfo;
use App\Models\PatientOrganization;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends BaseOrganizationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patient_table = (new Patient())->getTable();
        $clinic_table = (new Clinic())->getTable();
        $appointment_type_table = (new AppointmentType())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $room_table = (new Room())->getTable();
        $appointment_table = (new Appointment())->getTable();

        $appointments = Appointment::leftJoin(
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
                'specialist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin($room_table, 'room_id', '=', $room_table . '.id')
            ->where(
                $clinic_table . '.organization_id',
                auth()->user()->organization_id
            )
            ->orderBy("{$appointment_table}.date");

        if ($request->has('clinic_id')) {
            $appointments->where('clinic_id', $request->clinic_id);
        }

        $return = ['today' => [], 'tomorrow' => [], 'future' => []];
        $today = date('Y-m-d');

        $status = $request->status;

        if ($status == 'unconfirmed') {
            $appointments->where('confirmation_status', 'PENDING');

            $tomorrow = date_create($today);
            date_add($tomorrow, date_interval_create_from_date_string('1 day'));
            $tomorrow = date_format($tomorrow, 'Y-m-d');

            $appointments = $appointments
                ->where("{$appointment_table}.date", '>=', $today)
                ->get();

            foreach ($appointments as $appointment) {
                if ($appointment->date == $today) {
                    $return['today'][] = $appointment;
                }

                if ($appointment->date == $tomorrow) {
                    $return['tomorrow'][] = $appointment;
                }

                if ($appointment->date > $tomorrow) {
                    $return['future'][] = $appointment;
                }
            }
        } elseif ($status == 'unapproved') {
            $appointments->where('procedure_approval_status', 'NOT_APPROVED');

            $return = $appointments
                ->where("{$appointment_table}.date", '>=', $today)
                ->get();
        } elseif ($status == 'wait-listed') {
            $appointments->where('is_wait_listed', true);

            $return = $appointments
                ->where("{$appointment_table}.date", '>=', $today)
                ->get();
        } elseif ($status == 'cancellation') {
            $appointments->where('confirmation_status', 'CANCELED');

            $return = $appointments->get();
        }

        return response()->json(
            [
                'message' => 'Appointment List',
                'data' => $return,
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
            $patient = Patient::create($this->filterParams($request));
        }

        $patientOrganization = PatientOrganization::where(
            'patient_id',
            $patient->id
        )
            ->where('organization_id', $organization_id)
            ->first();

        if (empty($patientOrganization)) {
            PatientOrganization::create([
                'organization_id' => $organization_id,
                'patient_id' => $patient->id,
            ]);
        }

        $patientBilling = $patient->billing();

        if (empty($patientBilling)) {
            $patientBilling = PatientBilling::create([
                'patient_id' => $patient->id,
                ...$this->filterParams($request),
            ]);
        }

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
            ...$this->filterParams($request),
        ]);

        $appointmentAdministrationInfo = AppointmentAdministrationInfo::create([
            'appointment_id' => $appointment->id,
            ...$this->filterParams($request),
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
        $patient->update([...$this->filterParams($request)]);

        $patientOrganization = PatientOrganization::where(
            'patient_id',
            $patient->id
        )
            ->where('organization_id', $organization_id)
            ->first();

        if (empty($patientOrganization)) {
            PatientOrganization::create([
                'organization_id' => $organization_id,
                'patient_id' => $patient->id,
            ]);
        }

        $patientBilling = $patient->billing();

        $patientBilling->update([
            'patient_id' => $patient->id,
            ...$this->filterParams($request),
        ]);

        $appointment->update([
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
            ...$this->filterParams($request),
        ]);

        $appointmentAdministrationInfo = $appointment->administrationInfo();

        $appointmentAdministrationInfo->update([
            'appointment_id' => $appointment->id,
            ...$this->filterParams($request),
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
     * Check In
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkIn(Request $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointment = Appointment::find($request->id);

        if ($appointment->organization_id != $organization_id) {
            return $this->ForbiddenOrganization();
        }

        $appointment->confirmation_status = 'CONFIRMED';
        $appointment->attendance_status = 'CHECKED_IN';

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
     * Cancel Appointment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointment = Appointment::find($request->id);

        if ($appointment->organization_id != $organization_id) {
            return $this->ForbiddenOrganization();
        }

        $appointment->confirmation_status = 'CANCELED';

        $appointment->save();

        return response()->json(
            [
                'message' => 'Appointment Canceled',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Appointment wait listed
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function waitListed(Request $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointment = Appointment::find($request->id);

        if ($appointment->organization_id != $organization_id) {
            return $this->ForbiddenOrganization();
        }

        $appointment->is_wait_listed = (bool) $request->is_wait_listed;

        $appointment->save();

        $message = 'Appointment removed from wait listed';

        if ($appointment->is_wait_listed) {
            $message = 'Appointment added to wait listed';
        }

        return response()->json(
            [
                'message' => $message,
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

    /**
     * Filter params
     *
     * @param  \App\Http\Requests\AppointmentRequest  $request
     * @return array
     */
    protected function filterParams(AppointmentRequest $request)
    {
        $start_time = date('H:i:s', strtotime($request->time_slot[0]));
        $end_time = date('H:i:s', strtotime($request->time_slot[1]));

        $appointmentType = AppointmentType::find($request->appointment_type_id);
        $arrival_time = date(
            'H:i:s',
            strtotime($request->time_slot[0]) -
                60 * $appointmentType->arrival_time
        );

        if ($request->has('arrival_time')) {
            $arrival_time = date('H:i:s', strtotime($request->arrival_time));
        }

        $anesthetic_answers = $request->anesthetic_questions
            ? $request->anesthetic_answers
            : [];
        $procedure_answers = $request->procedure_questions
            ? $request->procedure_answers
            : [];

        $date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        $date = date('Y-m-d', strtotime($request->date));
        $referral_date = date('Y-m-d', strtotime($request->referral_date));
        $health_fund_card_expiry_date = date(
            'Y-m-d',
            strtotime($request->health_fund_expiry)
        );

        $referral_expiry_date = date_create($referral_date);

        if (is_numeric($request->referral_duration)) {
            date_add(
                $referral_expiry_date,
                date_interval_create_from_date_string(
                    $request->referral_duration . ' months'
                )
            );
        }

        $referral_expiry_date = date_format($referral_expiry_date, 'Y-m-d');

        $is_no_referral = true;

        if ($request->has('referring_doctor_id')) {
            $is_no_referral = false;
        }

        return [
            'UR_number' => $request->UR_number,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'home_number' => $request->home_number,
            'work_number' => $request->work_number,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'date_of_birth' => $date_of_birth,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->suburb,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
            'marital_status' => $request->input('marital_status', 'Single'),
            'birth_place_code' => $request->birth_place_code,
            'country_of_birth' => $request->country_of_birth,
            'birth_state' => $request->birth_state,
            'allergies' => $request->allergies,
            'aborginality' => $request->input('aborginality', false),
            'occupation' => $request->occupation,
            'height' => $request->height,
            'weight' => $request->weight,
            'bmi' => $request->bmi,
            'preferred_contact_method' => $request->input(
                'preferred_contact_method',
                'phone'
            ),
            'appointment_confirm_method' => $request->input(
                'appointment_confirm_method',
                'sms'
            ),

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
            'health_fund_id' => $request->health_fund,
            'health_fund_membership_number' => $request->health_fund_mem_number,
            'health_fund_card_expiry_date' => $health_fund_card_expiry_date,
            'fund_excess' => $request->fund_excess,

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
            'date' => $date,
            'arrival_time' => $arrival_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'actual_arrival_time' => $request->actual_arrival_time,
            'actual_start_time' => $request->actual_start_time,
            'actual_end_time' => $request->actual_end_time,
            'charge_type' => $request->charge_type,
            'anesthetic_answers' => json_encode($anesthetic_answers),
            'procedure_answers' => json_encode($procedure_answers),
            'referring_doctor_id' => $request->referring_doctor_id,
            'is_no_referral' => $is_no_referral,
            'no_referral_reason' => $request->no_referral_reason,
            'referral_date' => $referral_date,
            'referral_duration' => $request->referral_duration,
            'referral_expiry_date' => $referral_expiry_date,
            'note' => $request->note,
            'important_details' => $request->important_details,
            'clinical_alerts' => $request->clinical_alerts,
            'receive_forms' => $request->input('receive_forms', 'sms'),
            'recurring_appointment' => $request->input(
                'recurring_appointment',
                false
            ),
            'recent_service' => $request->recent_service,
            'outstanding_balance' => $request->outstanding_balance,
            'further_details' => $request->further_details,
            'fax_comment' => $request->fax_comment,
            'anything_should_aware' => $request->anything_should_aware,
            'collecting_person_name' => $request->collecting_person_name,
            'collecting_person_phone' => $request->collecting_person_phone,
            'collecting_person_alternate_contact' =>
                $request->collecting_person_alternate_contact,
        ];
    }
}
