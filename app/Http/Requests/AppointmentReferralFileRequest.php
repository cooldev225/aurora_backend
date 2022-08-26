<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam path                  string   required  The path is file name of referral pdf       Example: referral_file_4.pdf
*/
class AppointmentReferralFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * To do
         * Need to add auth condition
         */
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
            'path'   => 'required|string',
        ];
    }

}
