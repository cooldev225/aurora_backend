<?php

namespace App\Http\Requests;

use App\Enum\ProcedureApprovalStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
* @bodyParam perocedure_approval_status   enum   required   The status of the appointment procedures approval   Example: NOT_RELEVANT
*/
class AppointmentProcedureApprovalRequest extends FormRequest
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
            'procedure_approval_status' => ['required', new Enum(ProcedureApprovalStatus::class)],
        ];
    }
}
