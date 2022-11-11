<?php

namespace App\Http\Controllers;

use App\Models\HrmScheduleTimeslot;
use App\Http\Requests\HrmScheduleTimeslotRequest;


class HrmScheduleTimeslotController extends Controller
{

    public function index()
    {

        return response()->json(
            [
                'message' => 'Schedule templated updated',
                'data' => auth()->user()->organization
                    ->scheduleTimeslots
                    ->where('is_template', 1)
                    ->groupBy('user_id'),
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
        $hrmScheduleTimeslot = HrmScheduleTimeslot::create($request->validated());
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
    public function update(HrmScheduleTimeslotRequest $request)
    {
        $timeslots = $request->timeslots;
        $deleteTimeslots = $request->deleteTimeslots;

        if (count($deleteTimeslots) > 0) {
            foreach ($deleteTimeslots as $id) {
                $hrmScheduleTimeslot = HrmScheduleTimeslot::where('id', $id)->delete();
            }
        }

        foreach ($timeslots as $slot) {
            if (array_key_exists('id', $slot)) {
                $hrmScheduleTimeslot = HrmScheduleTimeslot::where('id', $slot['id'])->first();
                $hrmScheduleTimeslot->update($slot);
            } else {
                $hrmScheduleTimeslot = HrmScheduleTimeslot::create([
                    'organization_id' => auth()->user()->organization_id,
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                    'clinic_id' => $slot['clinic_id'],
                    'week_day' => $slot['week_day'],
                    'category' => $slot['category'],
                    'restriction' => $slot['restriction'],
                    'user_id' => $slot['user_id'],
                    'is_template' => $slot['is_template'],
                    'anesthetist_id'  => $slot['anesthetist_id'],
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\HrmScheduleTimeslot $hrmScheduleTimeslot
     * @return \Illuminate\Http\Response
     */
    public function destroy(HrmScheduleTimeslot $hrmScheduleTimeslot)
    {
        $hrmScheduleTimeslot->delete();
        return response()->json(
            [
                'message' => 'Schedule timeslot deleted',
            ],
            204
        );
    }
}
