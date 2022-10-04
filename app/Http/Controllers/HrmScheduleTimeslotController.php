<?php

namespace App\Http\Controllers;

use App\Models\HrmScheduleTimeslot;
use App\Http\Requests\HrmScheduleTimeslotRequest;


class HrmScheduleTimeslotController extends Controller
{

    public function index(){
        
        return response()->json(
            [
                'message' => 'Schedule templated updated',
                'data'    => auth()->user()->organization
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
     * @param  \App\Http\Requests\HrmScheduleTimeslotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HrmScheduleTimeslotRequest $request)
    {
        $hrmScheduleTimeslot = HrmScheduleTimeslot::create($request->validated());
        return response()->json(
            [
                'message' => 'Schedule templated created',
                'data'    => $hrmScheduleTimeslot,
            ],
            200
        );
    }

    /**
     * update a resource in storage.
     *
     * @param  \App\Http\Requests\HrmScheduleTimeslotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(HrmScheduleTimeslotRequest $request, HrmScheduleTimeslot $hrmScheduleTimeslot)
    {
        $hrmScheduleTimeslot->update($request->validated());
        return response()->json(
            [
                'message' => 'Timeslot updated',
                'data'    => $hrmScheduleTimeslot,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HrmScheduleTimeslot  $hrmScheduleTimeslot
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
