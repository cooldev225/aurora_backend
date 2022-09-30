<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HrmWeeklyScheduleTemplateRequest extends FormRequest
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
            'clinic_id' => 'required|numeric',
            'type'      => 'required|in:PERMANENT,CONTRACTOR,CASUAL',
            'role_id'   => 'required|numeric',
            'user_id'   => 'nullable|numeric',
            'timeslots' => 'required|array',
        ];
    }
}
