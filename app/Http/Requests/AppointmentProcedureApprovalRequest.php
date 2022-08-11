<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentProcedureApprovalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $appointment = $this->route('appointment');
        $organization_id = auth()->user()->organization_id;
        if ($appointment->organization_id == $organization_id) {
            return true;
        }
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
            'procedure_approval_status' => 'in:NOT_APPROVED,APPROVED,CONSULT_REQUIRED',
        ];
    }
}
