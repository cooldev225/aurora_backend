<?php

namespace App\Http\Controllers;

use App\Http\Requests\HrmWeeklyScheduleTemplateIndexRequest;
use App\Models\HrmWeeklyScheduleTemplate;
use App\Http\Requests\HrmWeeklyScheduleTemplateRequest;


class HrmWeeklyScheduleTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HrmWeeklyScheduleTemplateIndexRequest $request)
    {

        return response()->json(
            [
                'message' => 'Clinic List',
                'data' => HrmWeeklyScheduleTemplate::
                            where('clinic_id', $request->clinic_id)
                            ->with('timeslots')
                            ->get(),
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HrmWeeklyScheduleTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HrmWeeklyScheduleTemplateRequest $request)
    {
        $hrmWeeklyScheduleTemplate = HrmWeeklyScheduleTemplate::create($request->validated());
        return response()->json(
            [
                'message' => 'Schedule templated created',
                'data'    => $hrmWeeklyScheduleTemplate,
            ],
            200
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HrmWeeklyScheduleTemplateRequest  $request
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(HrmWeeklyScheduleTemplateRequest $request, HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        $hrmWeeklyScheduleTemplate->update($request->validated());
        return response()->json(
            [
                'message' => 'Schedule templated updated',
                'data'    => $hrmWeeklyScheduleTemplate,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        $hrmWeeklyScheduleTemplate->delete();
        return response()->json(
            [
                'message' => 'Schedule templated deleted',
            ],
            204
        );
    }
}
