<?php

namespace App\Http\Requests;

use App\Enum\ChargeType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AppointmentDraftCreateRequest extends FormRequest
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
            'clinic_id'            => 'numeric|exists:clinics,id',
            'appointment_type_id'  => 'required|numeric|exists:appointment_types,id',
            'specialist_id'        => 'required|numeric|exists:users,id',
            'date'                 => 'required|date',
            'arrival_time'         => 'required|string',
            'start_time'           => 'required|string',
            'note'                 => 'nullable|string',
            'charge_type'          => [new Enum(ChargeType::class)],
            'anesthetic_answers'   => 'required_if:anesthetic_questions,true|array',
            'anesthetic_questions' => 'nullable|boolean',
            'doctor_address_book_id'=> 'nullable|integer|exists:doctor_address_books,id',
            'referral_date'        => 'nullable|date',
            'referral_duration'    => 'nullable|integer',
            'claim_sources'        => 'nullable|array',
            'also_known_as'        => 'nullable|array',
            'draft_status'        => 'nullable|boolean',
//            'created_by'        => 'required|numeric|exists:users,id',
        ];
    }
}
