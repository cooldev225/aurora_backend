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
            'user_id'                       => 'required|numeric',
            'week_day'                      => 'required|in:MON,TUE,WED,THU,FRI,SAT,SUN',
            'category'                      => 'nullable|in:WORKING,BREAK,LEAVE',
            'start_time'                    => 'required',
            'end_time'                      => 'required',
            'restriction'                   => 'nullable|in:CONSULTATION,PROCEDURES,NONE',
            'is_template'                   => 'required|boolean',
        ];
    }
}
