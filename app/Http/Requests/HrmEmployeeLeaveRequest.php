<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HrmEmployeeLeaveRequest extends FormRequest
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
            "description" => "nullable|string",
            "organization_id" => "nullable|int",
            "userId" => "required|int",
            "status" => "nullable|string",
            "leaveType" => "required|string",
            "date" => "required|array",
            "isFullDay" => "required|boolean",
            "startTime" => "nullable|string",
            "endTime" => "nullable|string",
        ];
    }
}
