<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam title      string     required  The name of the report template                  Example: My Report
* @bodyParam sections   string[]   required  An array of sections to appear on the template
*/
class ReportTemplateRequest extends FormRequest
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
            'title'    => 'required|string',
            'sections' => 'required|array',
        ];
    }
}
