<?php

namespace App\Http\Controllers;

use App\Models\HrmScheduleTimeslots;
use App\Http\Requests\HrmScheduleTimeslotsRequest;


class HrmScheduleTimeslotsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HrmScheduleTimeslotsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HrmScheduleTimeslotsRequest $request)
    {
        $hrmScheduleTimeslots = HrmScheduleTimeslots::create($request->validated());
        return response()->json(
            [
                'message' => 'Schedule templated created',
                'data'    => $hrmScheduleTimeslots,
            ],
            200
        );
    }

    /**
     * update a resource in storage.
     *
     * @param  \App\Http\Requests\HrmScheduleTimeslotsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(HrmScheduleTimeslotsRequest $request, HrmScheduleTimeslots $hrmScheduleTimeslots)
    {
        $hrmScheduleTimeslots->update($request->validated());
        return response()->json(
            [
                'message' => 'Timeslot updated',
                'data'    => $hrmScheduleTimeslots,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HrmScheduleTimeslots  $hrmScheduleTimeslots
     * @return \Illuminate\Http\Response
     */
    public function destroy(HrmScheduleTimeslots $hrmScheduleTimeslots)
    {
        $hrmScheduleTimeslots->delete();
        return response()->json(
            [
                'message' => 'Schedule timeslot deleted',
            ],
            204
        );
    }
}
