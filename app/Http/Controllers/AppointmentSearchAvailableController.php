<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Specialist;
use App\Models\AppointmentTimeRequirement;

class AppointmentSearchAvailableController extends BaseOrganizationController
{

    /**
     * [Appointment] - Search Available
     *
     * @group Appointments
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @urlParam clinic_id           A Clinic id.                                Example: 1
     * @urlParam x_weeks             Number of weeks on the future to search.    Example: 2
     * @urlParam specialist_id       A Specialist Id.                            Example: 16
     * @urlParam appointment_type_id An Appointment Type id.                     Example: 3
     * @urlParam time_requirement    A Time Requirement Id.                      Example: 4
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $appointment_table = (new Appointment())->getTable();
        $specialist_table = (new Specialist())->getTable();

        $appointments = Appointment::organizationAppointmentsWithType()
            ->where('confirmation_status', '!=', 'CANCELED')
            ->orderBy("{$appointment_table}.date");

        $clinic_id = null;
        $x_weeks = 0;

        if ($request->filled('clinic_id')) {
            $clinic_id = $request->clinic_id;
        }

        if ($request->filled('x_weeks')) {
            $x_weeks = $request->x_weeks;
        }

        $specialist_list = Specialist::organizationSpecialists();

        if ($request->filled('specialist_id')) {
            $specialist_list->where(
                $specialist_table . '.id',
                $request->specialist_id
            );

            $appointments->where('specialist_id', $request->specialist_id);
        }

        $appointment_type = null;

        if ($request->filled('appointment_type_id')) {
            $appointment_type = AppointmentType::find(
                $request->appointment_type_id
            );
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
                        $clinic_id == $availability->locations->id) &&
                    (empty($appointment_type) ||
                        $appointment_type->type ==
                        $availability->appointment_type)
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
        $return = [];
        $x_weeks = $x_weeks * 7;

        date_add(
            $appointment_date,
            date_interval_create_from_date_string("{$x_weeks} days")
        );

        for ($i = 0; $i < 7; $i++) {
            $day_of_week = strtolower(date_format($appointment_date, 'l'));

            if (empty($day_of_weeks) || in_array($day_of_week, $day_of_weeks)) {
                $date = date_format($appointment_date, 'Y-m-d');
                $time_slot_list = [];

                if (!empty($specialists_by_week[$day_of_week])) {
                    $time_slot_list = $this->getTimeSlotList(
                        $specialists_by_week[$day_of_week]
                    );
                }

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
        }

        if ($request->filled('appointment_type_id')) {
            // extendable
        }

        if ($request->time_requirement != 0) {
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

        foreach ($appointments as $appointment) {
            $date_key = $appointment->date;
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
                    $index = array_search(
                        $appointment->specialist_id,
                        $return[$date_key]['time_slot_list'][$slot_key]['specialist_ids']
                    );

                    unset(
                        $return[$date_key]['time_slot_list'][$slot_key]['specialist_ids'][$index]
                    );
                }
            }
        }

        // Remove time slots which has no available specialists
        foreach ($return as $date_key => $date_item) {
            foreach ($date_item['time_slot_list'] as $slot_key => $slot) {
                if (empty($slot['specialist_ids'])) {
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

        $unixTime = strtotime('07:00:00');
        $start_time = date('H:i:s', $unixTime);
        $end_time = date('H:i:s', $unixTime + $appointment_time * 60);

        while ($end_time <= '18:00:00') {
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
                    $total_time_slots[$slot_key]['specialist_ids'][] = $specialist_id;
                }
            }
        }

        return $total_time_slots;
    }

}
