<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam specialist_id    int  The id of a specialist    Example: 1
* @bodyParam appointment_id   int  The id of an appointment  Example: 3
* @bodyParam patient_id       int  The id of a patient       Example: 7
* @bodyParam before_date      date documents before (including) this date Example: 08/12/1996
* @bodyParam after_date       date documents after (including) this date Example: 14/06/2001
* @bodyParam is_seen          boolean if the specialist has marked this as seen   Example: true
* @bodyParam origin           enum  How the document came into the system Example: CREATED (or UPLOADED, RECEIVED)
*/
class DocumentIndexRequest extends FormRequest
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
            'specialist_id'         => 'nullable|int',
            'appointment_id'        => 'nullable|int',
            'patient_id'            => 'nullable|int',
            'before_date'           => 'nullable|date',
            'after_date'            => 'nullable|date',
            'is_seen'               => 'nullable|boolean',
            'origin'                => 'nullable|In:CREATED,RECEIVED,UPLOADED',
            'is_missing_information'    =>'nullable|boolean',
        ];
    }
}
