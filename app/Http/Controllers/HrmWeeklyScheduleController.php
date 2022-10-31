<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Http\Requests\HrmScheduleTimeslotRequest;
use App\Http\Requests\HrmWeeklyscheduleIndexRequest;
use App\Http\Requests\HrmWeeklyScheduleRequest;
use App\Models\HrmWeeklySchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
    public function store(HrmScheduleTimeslotRequest $request)
    {
        $hrmScheduleTimeslot = HrmWeeklySchedule::create($request->validated());
        return response()->json(
            [
                'message' => 'Schedule templated created',
                'data' => $hrmScheduleTimeslot,
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

        if (count($deleteTimeslots) > 0) {
            foreach ($deleteTimeslots as $id) {
                $hrmScheduleTimeslot = HrmWeeklySchedule::where('id', $id)->delete();
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

        return response()->json(
            [
                'message' => 'Timeslot updated',
                'data' => $hrmScheduleTimeslot,
            ],
            200
        );
    }
}
