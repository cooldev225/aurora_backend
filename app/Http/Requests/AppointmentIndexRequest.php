<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam procedure_approval_status  string   
* @bodyParam confirmation_status        string   
* @bodyParam is_wait_listed             boolean e.g 1 or 0  
* @bodyParam before_date                date  
* @bodyParam after_date                 date  
* @bodyParam patient_id                 int 
* @bodyParam anesthetist_id                 int 
* @bodyParam specialist_id                 int  
*/
class AppointmentIndexRequest extends FormRequest
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
            'procedure_approval_status' => 'nullable|in:NOT_ASSESSED,NOT_RELEVANT,APPROVED,NOT_APPROVED,CONSULT_REQUIRED',
            'confirmation_status'       => 'nullable|in:CANCELED,PENDING,MISSED,CONFIRMED',
            'is_wait_listed'            => 'nullable|boolean',
            'after_date'                => 'nullable|date',
            'before_date'               => 'nullable|date',
            'date'                      => 'nullable|date',
            'patient_id'                => 'nullable|numeric',
            'anesthetist_id'            => 'nullable|numeric',
            'specialist_id'             => 'nullable|numeric',
        ];
    }
}
