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
use App\Models\AppointmentTimeRequirement;
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
        $appointment_table = (new Appointment())->getTable();

        $appointments = Appointment::organizationAppointmentsWithType()->orderBy(
            "{$appointment_table}.date"
        );

        if ($request->has('clinic_id')) {
            $appointments->where('clinic_id', $request->clinic_id);
        }

        if ($request->filled('appointment_type_id')) {
            $appointments->where(
                'appointment_type_id',
                $request->appointment_type_id
            );
        }

        if ($request->filled('specialist_ids')) {
            $appointments->whereIn('specialist_id', $request->specialist_ids);
        }

        if ($request->filled('time_requirement')) {
            $appointment_time_requirement = AppointmentTimeRequirement::find(
                $request->time_requirement
            );

            if (strtolower($appointment_time_requirement->type) == 'before') {
                $appointments->where(
                    "start_time', '<',{$appointment_time_requirement->base_time}'"
                );
            } elseif (
                strtolower($appointment_time_requirement->type) == 'after'
            ) {
                $appointments->where(
                    "end_time', '>',{$appointment_time_requirement->base_time}'"
                );
            }
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
        } elseif ($status == 'available') {
            $appointments
                ->where('procedure_approval_status', 'APPROVED')
                ->where('confirmation_status', 'CONFIRMED')
                ->where("{$appointment_table}.date", '>=', $today);

            $appointments = $appointments->get();

            $search_dates = [];
            $appointment_date = date_create($today);

            for ($i = 0; $i < 7; $i++) {
                $search_dates[] = date_format($appointment_date, 'Y-m-d');
                date_add(
                    $appointment_date,
                    date_interval_create_from_date_string('1 day')
                );
            }

            $return = [];

            foreach ($search_dates as $search_date) {
                $formatted_date = date('D jS', strtotime($search_date));
                $return[$formatted_date] = [];

                foreach ($appointments as $appointment) {
                    if ($appointment->date == $search_date) {
                        $return[$formatted_date][] = $appointment;
                    }
                }
            }
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
     * Return available time slots
     *
     * @return \Illuminate\Http\Response
     */
    public function availableSlots(Request $request)
    {
        $appointment_table = (new Appointment())->getTable();
        $specialist_table = (new Specialist())->getTable();

        $appointments = Appointment::organizationAppointmentsWithType()->orderBy(
            "{$appointment_table}.date"
        );

        $clinic_id = null;

        if ($request->filled('clinic_id')) {
            $clinic_id = $request->clinic_id;
        }

        $specialist_list = Specialist::organizationSpecialists();

        if ($request->filled('specialist_ids')) {
            $specialist_list->whereIn(
                $specialist_table . '.id',
                $request->specialist_ids
            );

            $appointments->whereIn('specialist_id', $request->specialist_ids);
        }

        $specialists = $specialist_list->get()->toArray();
        $appointments = $appointments->get();
        $specialists_by_week = [];

        foreach ($specialists as $key => $specialist) {
            $work_hours = (array) json_decode($specialist['work_hours']);
            $specialists[$key]['work_hours'] = $work_hours;

            foreach ($work_hours as $week => $availability) {
                if (
                    $availability->available &&
                    (empty($clinic_id) ||
                        in_array($clinic_id, $availability->clinic_id))
                ) {
                    if (empty($specialists_by_week[$week])) {
                        $specialists_by_week[$week] = [];
                    }

                    $specialists_by_week[$week][$specialist['id']] =
                        $availability->time_slot;
                }
            }
        }

        $today = date('Y-m-d');
        $day_of_weeks = [];

        if ($request->filled('day_of_weeks')) {
            $day_of_weeks = $request->day_of_weeks;
        }

        $appointment_date = date_create($today);
        $date_count = 0;
        $return = [];

        for ($i = 0; $i < 49; $i++) {
            $day_of_week = strtolower(date_format($appointment_date, 'l'));

            if (empty($day_of_weeks) || in_array($day_of_week, $day_of_weeks)) {
                $date = date_format($appointment_date, 'Y-m-d');
                $time_slot_list = $this->getTimeSlotList(
                    $specialists_by_week[$day_of_week]
                );

                $return[$date] = [
                    'date' => $date,
                    'formatted_date' => date_format($appointment_date, 'D jS'),
                    'day_of_week' => $day_of_week,
                    'time_slot_list' => $time_slot_list,
                ];
            }

            date_add(
                $appointment_date,
                date_interval_create_from_date_string('1 day')
            );

            $date_count++;

            if ($date_count >= 7) {
                break;
            }
        }

        if ($request->filled('appointment_type_id')) {
            // extendable
        }

        if ($request->filled('time_requirement')) {
            $appointment_time_requirement = AppointmentTimeRequirement::find(
                $request->time_requirement
            );

            foreach ($return as $date_key => $date_item) {
                foreach ($date_item['time_slot_list'] as $slot_key => $slot) {
                    if (
                        strtolower($appointment_time_requirement->type) ==
                            'before' &&
                        $slot['end_time'] >
                            $appointment_time_requirement->base_time
                    ) {
                        unset($return[$date_key]['time_slot_list'][$slot_key]);
                    } elseif (
                        strtolower($appointment_time_requirement->type) ==
                            'after' &&
                        $slot['start_time'] <
                            $appointment_time_requirement->base_time
                    ) {
                        unset($return[$date_key]['time_slot_list'][$slot_key]);
                    }
                }
            }
        }

        foreach ($appointments as $date_key => $appointment) {
            $date_item = empty($return[$date_key])
                ? ['time_slot_list' => []]
                : $return[$date_key];

            foreach ($date_item['time_slot_list'] as $slot_key => $slot) {
                if (
                    $appointment->checkConflict(
                        $slot['start_time'],
                        $slot['end_time']
                    )
                ) {
                    $return[$date_key]['time_slot_list'][$slot_key][
                        'specialist_ids'
                    ][$appointment->specialist_id] = 0;
                }
            }
        }

        // Remove time slots which has no available specialists
        foreach ($return as $date_key => $date_item) {
            foreach ($date_item['time_slot_list'] as $slot_key => $slot) {
                $specialist_count = 0;

                foreach ($slot['specialist_ids'] as $key => $value) {
                    $specialist_count += $value;
                }

                if ($specialist_count == 0) {
                    unset($return[$date_key]['time_slot_list'][$slot_key]);
                }
            }
        }

        return response()->json(
            [
                'message' => 'Available Time Slots',
                'data' => $return,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * return Time slots array
     */
    protected function getTimeSlotList($specialist_list)
    {
        $total_time_slots = [];

        $appointment_time = auth()
            ->user()
            ->organization()->appointment_length;

        $unixTime = strtotime('00:00:00');
        $start_time = date('H:i:s', $unixTime);
        $end_time = date('H:i:s', $unixTime + $appointment_time * 60);

        while ($start_time < $end_time) {
            $total_time_slots[$start_time] = [
                'start_time' => $start_time,
                'end_time' => $end_time,
            ];

            $unixTime = $unixTime + $appointment_time * 60;
            $start_time = date('H:i:s', $unixTime);
            $end_time = date('H:i:s', $unixTime + $appointment_time * 60);
        }

        foreach ($specialist_list as $specialist_id => $time) {
            foreach ($total_time_slots as $slot_key => $time_slot) {
                if (empty($total_time_slots[$slot_key]['specialist_ids'])) {
                    $total_time_slots[$slot_key]['specialist_ids'] = [];
                }

                if (
                    !empty($time) &&
                    !empty($time[0]) &&
                    !empty($time[1]) &&
                    $this->timeContainsSlot(
                        $time[0],
                        $time[1],
                        $time_slot['start_time'],
                        $time_slot['end_time']
                    )
                ) {
                    $total_time_slots[$slot_key]['specialist_ids'][
                        $specialist_id
                    ] = 1;
                }
            }
        }

        return $total_time_slots;
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
                ...$this->filterParams($request),
                'patient_id' => $patient->id,
            ]);
        }

        $appointment = Appointment::create([
            ...$this->filterParams($request),
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
        ]);

        $appointmentAdministrationInfo = AppointmentAdministrationInfo::create([
            ...$this->filterParams($request),
            'appointment_id' => $appointment->id,
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
            ...$this->filterParams($request),
            'patient_id' => $patient->id,
        ]);

        $appointment->update([
            ...$this->filterParams($request),
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
        ]);

        $appointmentAdministrationInfo = $appointment->administrationInfo();

        $appointmentAdministrationInfo->update([
            ...$this->filterParams($request),
            'appointment_id' => $appointment->id,
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
     * Procedure Approve by Anesthetist
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointment = Appointment::find($request->id);

        if ($appointment->organization_id != $organization_id) {
            return $this->forbiddenOrganization();
        }

        if ($appointment->anesthetist_id != auth()->user()->id) {
            return response()->json(
                [
                    'message' =>
                        'Should be the anesthetist of this appointment',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $appointment->procedure_approval_status = 'APPROVED';

        $appointment->save();

        return response()->json(
            [
                'message' => 'Appointment Approved',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Procedure Decline by Anesthetist
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointment = Appointment::find($request->id);

        if ($appointment->organization_id != $organization_id) {
            return $this->forbiddenOrganization();
        }

        if ($appointment->anesthetist_id != auth()->user()->id) {
            return response()->json(
                [
                    'message' =>
                        'Should be the anesthetist of this appointment',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $appointment->procedure_approval_status = 'NOT_APPROVED';

        $appointment->save();

        return response()->json(
            [
                'message' => 'Appointment Declined',
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
            return $this->forbiddenOrganization();
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
            return $this->forbiddenOrganization();
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
            return $this->forbiddenOrganization();
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
                15 * 60 * $appointmentType->arrival_time
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

        $referral_date = date('Y-m-d', strtotime($request->referral_date));

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
        $referral_params = [];

        if ($request->has('referring_doctor_id')) {
            $is_no_referral = false;

            $referral_params = [
                'referral_date' => $referral_date,
                'referral_expiry_date' => $referral_expiry_date,
            ];
        }

        $clinic_id = 0;

        if ($request->has('clinic_id')) {
            $clinic_id = $request->clinic_id;
        } else {
            $day = date('l', strtotime($request->date));
            $day = strtolower($day);
            $work_hours = json_decode(
                Specialist::find($request->specialist_id)->employee()
                    ->work_hours
            );

            $clinic_id = $work_hours->$day->locations->id;
        }

        $filtered_request = [
            'clinic_id' => $clinic_id,
            'date_of_birth' => date(
                'Y-m-d',
                strtotime($request->date_of_birth)
            ),
            'marital_status' => $request->input('marital_status', 'Single'),
            'aborginality' => $request->input('aborginality', false),
            'preferred_contact_method' => $request->input(
                'preferred_contact_method',
                'phone'
            ),
            'appointment_confirm_method' => $request->input(
                'appointment_confirm_method',
                'sms'
            ),
            'medicare_expiry_date' => date(
                'Y-m-d',
                strtotime($request->medicare_expiry_date)
            ),
            'concession_expiry_date' => date(
                'Y-m-d',
                strtotime($request->concession_expiry_date)
            ),
            'pension_expiry_date' => date(
                'Y-m-d',
                strtotime($request->pension_expiry_date)
            ),
            'healthcare_card_expiry_date' => date(
                'Y-m-d',
                strtotime($request->healthcare_card_expiry_date)
            ),
            'health_fund_expiry_date' => date(
                'Y-m-d',
                strtotime($request->health_fund_expiry_date)
            ),
            'primary_pathologist_id' => $request->input(
                'primary_pathologist_id',
                0
            ),
            'date' => date('Y-m-d', strtotime($request->date)),
            'arrival_time' => $arrival_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'anesthetic_answers' => json_encode($anesthetic_answers),
            'procedure_answers' => json_encode($procedure_answers),
            'referring_doctor_id' => $request->referring_doctor_id,
            'is_no_referral' => $is_no_referral,
            'no_referral_reason' => $request->no_referral_reason,
            'receive_forms' => $request->input('receive_forms', 'sms'),
            'recurring_appointment' => $request->input(
                'recurring_appointment',
                false
            ),
        ];

        return array_merge(
            $request->all(),
            $filtered_request,
            $referral_params
        );
    }
}
