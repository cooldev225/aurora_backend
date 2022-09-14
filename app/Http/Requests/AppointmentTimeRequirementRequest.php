<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam title       string      required   The name of time requirement
* @bodyParam base_time   timestamp   required   The timestamp of the time requirement
*/
class AppointmentTimeRequirementRequest extends FormRequest
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
            'title'     => 'required|string',
            'base_time' => 'required',
        ];
    }
}
