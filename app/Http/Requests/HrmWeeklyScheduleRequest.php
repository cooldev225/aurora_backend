<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HrmWeeklyScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'timeslots' => 'nullable|array',
            'deleteTimeslots' => 'nullable|array',
            'deleteTimeslots.*.hrm_weekly_schedule_id' => 'required|integer',
            'deleteTimeslots.*.reason' => 'required|string',
            'timeslots.*.week_day' => 'required|in:MON,TUE,WED,THU,FRI,SAT,SUN',
            'timeslots.*.category' => 'nullable|in:WORKING,BREAK,LEAVE',
            'timeslots.*.start_time' => 'required',
            'timeslots.*.end_time' => 'required',
            'timeslots.*.date' => 'required',
            'timeslots.*.restriction' => 'nullable|in:CONSULTATION,PROCEDURE,NONE',
            'timeslots.*.is_template' => 'required|boolean',
            'timeslots.*.anesthetist_id' => 'nullable|integer',
            'timeslots.*.user_id' => 'nullable|integer',
        ];
    }
}
