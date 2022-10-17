<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HrmScheduleTimeslotRequest extends FormRequest
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
            'deleteTimeslots.*' => 'nullable|integer',
            'timeslots.*.week_day' => 'required|in:MON,TUE,WED,THU,FRI,SAT,SUN',
            'timeslots.*.category' => 'nullable|in:WORKING,BREAK,LEAVE',
            'timeslots.*.start_time' => 'required',
            'timeslots.*.end_time' => 'required',
            'timeslots.*.restriction' => 'nullable|in:CONSULTATION,PROCEDURE,NONE',
            'timeslots.*.is_template' => 'required|boolean',
            'timeslots.*.anesthetist_id' => 'nullable|integer',
            'timeslots.*.user_id' => 'nullable|integer',
        ];
    }
}
