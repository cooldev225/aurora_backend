<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnestheticAnswerRequest extends FormRequest
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
            'appointment_id' => 'required|numeric',
            'question_id'    => 'required|numeric',
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
            'appointment_id' => [
                'description' => '',
                'example'     => '',
            ],
            'question_id' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
