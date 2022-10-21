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
        return false;
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
            'week_day' => 'required|in:MON,TUE,WED,THU,FRI,SAT,SUN',
            'category' => 'nullable|in:WORKING,BREAK,LEAVE',
            'start_time' => 'required|String',
            'end_time' => 'required|String',
            'date' => 'required|String',
            'restriction' => 'nullable|in:CONSULTATION,PROCEDURE,NONE',
            'status' => 'nullable|in:PUBLISHED','UNPUBLISHED','CANCELED',
            'is_template' => 'required|boolean',
            'anesthetist_id' => 'nullable|integer',
            'hrm_schedule_timeslot_id' => 'nullable|integer',
            'user_id' => 'nullable|integer',
        ];
    }
}
