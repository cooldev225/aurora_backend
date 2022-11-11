<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Http\Requests\HrmWeeklyscheduleIndexRequest;
use App\Http\Requests\HrmWeeklyScheduleRequest;
use App\Http\Requests\HrmWeeklyScheduleStoreRequest;
use App\Mail\EmployeeScheduleEmail;
use App\Models\HrmDeletedSchedule;
use App\Models\HrmWeeklySchedule;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Log;


class HrmWeeklyScheduleController extends Controller
{
    public function index(HrmWeeklyscheduleIndexRequest $request)
    {
        $params = $request->validated();

        // Verify the user can access this function via policy
        $this->authorize('viewAny', [User::class, auth()->user()->organization_id]);

        $organization = auth()->user()->organization;
        $startDate = Carbon::parse($params['date'])->startOfWeek()->format('Y-m-d');
        $endDate = Carbon::parse($params['date'])->endOfWeek()->format('Y-m-d');

        $users = User::where(
            'organization_id',
            $organization->id
        )->wherenot('role_id', UserRole::ADMIN)
            ->wherenot('role_id', UserRole::ORGANIZATION_ADMIN)
            ->with(
                ['hrmWeeklySchedule' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate]);
                }
                ])->get();
        return response()->json(
            [
                'message' => 'Schedule template ' . $startDate . ' ' . $endDate,
                'data' => $users,
            ],
            200
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\HrmScheduleTimeslotRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HrmWeeklyScheduleStoreRequest $request)
    {
        $weekDays = [];
        $clinicIds = [];
        $employeeIds = [];
        $startDate = Carbon::parse($request->date)->startOfWeek()->format('Y-m-d');
        $endDate = Carbon::parse($request->date)->endOfWeek()->format('Y-m-d');
        $period = CarbonPeriod::create(Carbon::parse($request->date)->startOfWeek(),
            Carbon::parse($request->date)->endOfWeek());
        $organization = auth()->user()->organization;


        foreach ($period as $day) {
            $weekDays[strtoupper($day->format('D'))] = $day->toDateString();
        }

        foreach ($request->clinics as $clinic) {
            array_push($clinicIds, $clinic['id']);
        }
        foreach ($request->employees as $employee) {
            array_push($employeeIds, $employee['id']);
        }

        // Delete existing weekly schedules
        $weeklySlots = HrmWeeklySchedule::whereBetween('date', [$startDate, $endDate])
            ->whereIn('user_id', $employeeIds)
            ->whereIn('clinic_id', $clinicIds)->delete();

        //Fill hrm weekly schedule from user template
        foreach ($request->employees as $employee) {
            foreach ($employee['schedule_timeslots'] as $slot) {
                HrmWeeklySchedule::create([
                    'organization_id' => $slot['organization_id'],
                    'date' => $weekDays[$slot['week_day']],
                    'clinic_id' => $slot['clinic_id'],
                    'week_day' => $slot['week_day'],
                    'category' => $slot['category'],
                    'user_id' => $slot['user_id'],
                    'anesthetist_id' => $slot['anesthetist_id'],
                    'hrm_schedule_timeslot_id' => $slot['id'],
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                    'status' => 'UNPUBLISHED',
                    'is_template' => true,
                ]);
            }

        }
        return response()->json(
            [
                'message' => 'Schedule templated created'
            ],
            200
        );
    }

    /**
     * update a resource in storage.
     *
     * @param \App\Http\Requests\HrmScheduleTimeslotRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(HrmWeeklyScheduleRequest $request)
    {
        $timeslots = $request->timeslots;
        $deleteTimeslots = $request->deleteTimeslots;
        $notifyUsers = $request->notifyUsers;

        if (count($deleteTimeslots) > 0) {
            foreach ($deleteTimeslots as $slot) {
                $hrmScheduleTimeslot = HrmWeeklySchedule::where('id', $slot["hrm_weekly_schedule_id"])->first();

                // Create delete record on Hrm deleted schedules table
                HrmDeletedSchedule::create([
                    'start_time' => $hrmScheduleTimeslot->start_time,
                    'end_time' => $hrmScheduleTimeslot->end_time,
                    'date' => $hrmScheduleTimeslot->date,
                    'organization_id' => $hrmScheduleTimeslot->organization_id,
                    'clinic_id' => $hrmScheduleTimeslot->clinic_id,
                    'user_id' => $hrmScheduleTimeslot->user_id,
                    'reason' => $slot["reason"],
                    'week_day' => $hrmScheduleTimeslot->week_day,
                    'category' => $hrmScheduleTimeslot->category,
                    'restriction' => $hrmScheduleTimeslot->restriction,
                    'status' => $hrmScheduleTimeslot->status,
                ]);

                $hrmScheduleTimeslot->delete();
            }
        }

        foreach ($timeslots as $slot) {
            if (array_key_exists('id', $slot)) {
                $hrmScheduleTimeslot = HrmWeeklySchedule::where('id', $slot['id'])->first();
                $hrmScheduleTimeslot->update($slot);
            } else {
                $hrmScheduleTimeslot = HrmWeeklySchedule::create([
                    'organization_id' => auth()->user()->organization_id,
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                    'date' => $slot['date'],
                    'clinic_id' => $slot['clinic_id'],
                    'week_day' => $slot['week_day'],
                    'category' => $slot['category'],
                    'restriction' => $slot['restriction'],
                    'user_id' => $slot['user_id'],
                    'is_template' => $slot['is_template'],
                    'anesthetist_id' => $slot['anesthetist_id'],
                    'status' => $slot['status'],
                ]);
            }
        }

        // Sending Email notifications
        $notifyUsers = array_values(array_unique($notifyUsers, SORT_NUMERIC));
        $startDate = Carbon::parse($request->date)->startOfWeek()->format('Y-m-d');
        $endDate = Carbon::parse($request->date)->endOfWeek()->format('Y-m-d');
        $period = CarbonPeriod::create(Carbon::parse($request->date)->startOfWeek(), Carbon::parse($request->date)->endOfWeek());

        foreach ($notifyUsers as $user) {
            $user = User::where('id', $user)
                ->with(
                    ['hrmWeeklySchedule' => function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('date', [$startDate, $endDate]);
                    }
                    ])->first();
            $user->sendEmail(new EmployeeScheduleEmail($user, $period));
        }

        return response()->json(
            [
                'message' => 'Timeslot updated',
                'data' => $hrmScheduleTimeslot,
            ],
            200
        );
    }
}
