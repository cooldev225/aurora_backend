<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam type   string   required   The type of file that is being returned   Example: REFERRAL
* @bodyParam path   string   required   The name of the file being returned   Example: referral_file_4.pdf
*/
class FileRequest extends FormRequest
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
            'type'   => 'required|string',
            'path'   => 'required|string',
        ];
    }

}
