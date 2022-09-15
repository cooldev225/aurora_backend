<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam code          string  required  The 4-digit birth code
* @bodyParam description   string  required  The description of the birth code
*/
class BirthCodeRequest extends FormRequest
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
            'code'        => 'required|numeric|digits:4',
            'description' => 'required|string',
        ];
    }
}