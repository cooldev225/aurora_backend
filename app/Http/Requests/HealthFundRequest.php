<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam name      string   required   The name of the health fund
* @bodyParam code      string   required   The code of the health fund
* @bodyParam fund      string   required   The parent fund of the fund
* @bodyParam contact   string   required   The contact at the fund
* @bodyParam issues    string   required   Existing issues with the fund
*/
class HealthFundRequest extends FormRequest
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
            'name'    => 'required|string',
            'code'    => 'required|string',
            'fund'    => 'required|string',
            'contact' => 'required|string',
            'issues'  => 'required|string',
        ];
    }
}
