<?php

namespace App\Http\Controllers;

use App\Http\Requests\HrmWeeklyScheduleTemplateIndexRequest;
use App\Models\HrmWeeklyScheduleTemplate;
use App\Http\Requests\StoreHrmWeeklyScheduleTemplateRequest;
use App\Http\Requests\UpdateHrmWeeklyScheduleTemplateRequest;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHrmWeeklyScheduleTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHrmWeeklyScheduleTemplateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHrmWeeklyScheduleTemplateRequest  $request
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHrmWeeklyScheduleTemplateRequest $request, HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        //
    }
}
