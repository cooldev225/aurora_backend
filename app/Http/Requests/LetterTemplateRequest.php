<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam heading   string  required  The heading of the letter template
* @bodyParam body      string  required  The body of the letter template
*/
class LetterTemplateRequest extends FormRequest
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
            'heading'   => 'required|string',
            'body'      => 'required|string',
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
            'heading' => [
                'description' => '',
                'example'     => '',
            ],
            'body' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
