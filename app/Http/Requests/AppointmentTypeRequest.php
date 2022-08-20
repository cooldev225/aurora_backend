<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentTypeRequest extends FormRequest
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
            'name'                  => 'required',
            'anesthetist_required'  => 'required|boolean',
            'invoice_by'            => 'required',
            'arrival_time'          => 'required|numeric',
            'procedure_price'       => 'numeric',
        ];
    }

    /**
     * Get the description of body parameters.
     *
     * @return array<string, array>
     */
    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => '',
                'example'     => '',
            ],
            'anesthetist_required' => [
                'description' => '',
                'example'     => '',
            ],
            'invoice_by' => [
                'description' => '',
                'example'     => '',
            ],
            'arrival_time' => [
                'description' => '',
                'example'     => '',
            ],
            'procedure_price' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
